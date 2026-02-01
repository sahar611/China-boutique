<?php
namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Services\CartService;
use Illuminate\Http\Request;
  use App\Models\CartItem;
class CartController extends Controller
{
    public function __construct(private CartService $cart) {}

    public function index(Request $request)
    {
        $cart = $this->cart->currentCart($request)->load('items.product.images');
        return view('front.cart', compact('cart'));
    }

    public function add(Request $request, Product $product)
    {
        $qty = (int) $request->input('qty', 1);
        $cart = $this->cart->add($request, $product, $qty);

        if ($request->wantsJson()) {
            return response()->json($this->cartPayload($cart));
        }

        return back()->with('success', __('messages.added_to_cart'));
    }

    public function qty(Request $request, Product $product)
    {
        $qty = (int) $request->input('qty', 1);
        $cart = $this->cart->updateQty($request, $product, $qty);

        return $request->wantsJson()
            ? response()->json($this->cartPayload($cart))
            : back();
    }

    public function remove(Request $request, Product $product)
    {
        $cart = $this->cart->remove($request, $product);

        return $request->wantsJson()
            ? response()->json($this->cartPayload($cart))
            : back();
    }

    private function cartPayload($cart): array
    {
        $itemsCount = $cart->items->sum('qty');

        $subtotal = 0;
        foreach ($cart->items as $item) {
            $unit = (float)($item->unit_sale_price ?? 0);
            $unit = ($unit > 0 && $unit < (float)$item->unit_price) ? $unit : (float)$item->unit_price;
            $subtotal += $unit * (int)$item->qty;
        }

        return [
            'items_count' => $itemsCount,
            'subtotal' => round($subtotal, 2),
        ];
    }
  

public function mini(Request $request)
{
    $cart = $this->cart->currentCart($request)->load(['items.product.images']);

   
    $currency = session('currency') ?? \App\Services\CurrencyService::current();
    $rate = 1.0;
    $symbol = 'ر.س'; 

    if (is_object($currency)) {
        $rate = (float)($currency->rate ?? 1);
        $symbol = $currency->symbol ?? $symbol;
    } elseif (is_array($currency)) {
        $rate = (float)($currency['rate'] ?? 1);
        $symbol = $currency['symbol'] ?? $symbol;
    }

    return view('front.partials.mini-cart', compact('cart', 'rate', 'symbol'));
}

public function miniRemove(Request $request, CartItem $item)
{
    $cart = $this->cart->currentCart($request);

  
    if ($item->cart_id !== $cart->id) {
        abort(403);
    }

    $item->delete();

   
    return $this->mini($request);
}

}
