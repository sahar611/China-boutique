<?php 
namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Services\CartService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    public function __construct(private CartService $cart) {}

    public function index(Request $request)
    {
        $cart = $this->cart->currentCart($request)->load('items.product');

        if ($cart->items->isEmpty()) {
            return redirect()->route('cart.index')->with('info', __('home.cart_empty'));
        }

        $user = Auth::user();

        // افترض إن عندك address + phone في جدول users
        // هنملي الفورم تلقائيًا من البروفايل
        return view('front.checkout', compact('cart', 'user'));
    }

    public function place(Request $request)
    {
        $cart = $this->cart->currentCart($request)->load('items.product');

        if ($cart->items->isEmpty()) {
            return back()->with('error', __('home.cart_empty'));
        }

        // بيانات المستخدم من البروفايل (مش من فورم)
        $user = Auth::user();

        // طريقة الدفع فقط من الفورم
        $data = $request->validate([
            'payment_method' => ['required', 'in:bank,online'],
            'bank_receipt'   => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
        ]);

        if ($data['payment_method'] === 'bank' && !$request->hasFile('bank_receipt')) {
            return back()->withErrors([
                'bank_receipt' => (app()->getLocale()=='en' ? 'Bank receipt is required.' : 'صورة الإيصال البنكي مطلوبة.')
            ]);
        }

        // حساب subtotal بنفس منطق CartController عندك
        $subtotal = 0;
        foreach ($cart->items as $item) {
            $unit = (float)($item->unit_sale_price ?? 0);
            $unit = ($unit > 0 && $unit < (float)$item->unit_price) ? $unit : (float)$item->unit_price;
            $subtotal += $unit * (int)$item->qty;
        }

        $shipping = 0;
        $discount = 0;
        $total = $subtotal + $shipping - $discount;

        $order = DB::transaction(function () use ($request, $data, $user, $cart, $subtotal, $shipping, $discount, $total) {

            $receiptPath = null;
            if ($request->hasFile('bank_receipt')) {
                $receiptPath = $request->file('bank_receipt')->store('orders/receipts', 'public');
            }

            $order = Order::create([
                'code'             => 'ORD-' . strtoupper(Str::random(8)),
                'user_id'          => $user->id,

                // من البروفايل
                'customer_name'    => $user->name,
                'customer_email'   => strtolower($user->email),
                'customer_phone'   => $user->phone ?? null,
                'shipping_address' => $user->address ?? null,

                'currency_code'    => 'SAR',
                'currency_rate'    => 1,

                'subtotal'         => round($subtotal, 2),
                'shipping'         => round($shipping, 2),
                'discount'         => round($discount, 2),
                'total'            => round($total, 2),

                'payment_method'   => $data['payment_method'],
                'payment_status'   => $data['payment_method'] === 'bank' ? 'pending' : 'pending',
                'status'           => 'new',
                'bank_receipt'     => $receiptPath,
                'placed_at'        => now(),
            ]);

            foreach ($cart->items as $item) {
                $unit = (float)($item->unit_sale_price ?? 0);
                $unit = ($unit > 0 && $unit < (float)$item->unit_price) ? $unit : (float)$item->unit_price;

                OrderItem::create([
                    'order_id'        => $order->id,
                    'product_id'      => $item->product_id,
                    'product_name'    => $item->product?->name_en ?? $item->product?->name_ar ?? 'Product',
                    'unit_price'      => (float)$item->unit_price,
                    'unit_sale_price' => (float)($item->unit_sale_price ?? 0),
                    'qty'             => (int)$item->qty,
                    'line_total'      => round($unit * (int)$item->qty, 2),
                ]);
            }

            // فضي الكارت بعد إنشاء الطلب
            $cart->items()->delete();

            return $order;
        });

        // ✅ لو Online: وديه للدفع أونلاين
        if ($order->payment_method === 'online') {
            return redirect()->route('checkout.pay', $order->code);
        }

        // ✅ تحويل بنكي: يروح thankyou فورًا
        return redirect()->route('checkout.thankyou', $order->code)
            ->with('success', __('home.order_placed'));
    }

    // Placeholder للدفع الأونلاين
    public function pay(Order $order)
    {
        // هنا هتربط بوابة الدفع (Moyasar/Stripe/...)
        // الفكرة: تعمل redirect لبوابة الدفع ومعاك order->code + total

        // مؤقتًا (للتجربة) اعتبرنا الدفع تم:
        // في الحقيقي: ده لازم يحصل بعد callback/webhook مش هنا
        $order->update([
            'payment_status' => 'paid',
            'status' => 'processing',
        ]);

        return redirect()->route('checkout.thankyou', $order->code)
            ->with('success', app()->getLocale()=='en' ? 'Payment successful.' : 'تم الدفع بنجاح.');
    }

    public function thankyou(Order $order)
    {
        // حماية: الطلب يخص نفس المستخدم
        abort_unless($order->user_id === Auth::id(), 403);

        $order->load('items');

        return view('front.checkout_thankyou', compact('order'));
    }
}
