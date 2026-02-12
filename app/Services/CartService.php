<?php
namespace App\Services;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
 use App\Models\ProductVariant;
 use Illuminate\Support\Facades\Auth;

class CartService
{
   public function currentCart(Request $request, ?string $guestSessionId = null): Cart
{
    $userId = \Illuminate\Support\Facades\Auth::guard('web')->id();
    $sessionId = $guestSessionId ?: $request->session()->getId();

    if ($userId) {
        $userCart = Cart::firstOrCreate(['user_id' => $userId], [
            'session_id' => null,
            'currency_code' => session('currency.code') ?? null,
        ]);

        $guestCart = Cart::whereNull('user_id')->where('session_id', $sessionId)->first();
        if ($guestCart && $guestCart->id !== $userCart->id) {
            $this->mergeCarts($guestCart, $userCart);
        }

        return $userCart;
    }

    return Cart::firstOrCreate(['session_id' => $sessionId, 'user_id' => null], [
        'currency_code' => session('currency.code') ?? null,
    ]);
}


   

public function add(Request $request, Product $product, int $qty = 1): Cart
{
    if (!(int)$product->is_active) {
        abort(404);
    }

    $qty = max(1, min(999, $qty));

    // ✅ هات variant_id من الطلب (من صفحة التفاصيل)
    $variantId = $request->input('variant_id');
    $variant = null;

    // لو المنتج ليه مقاسات: اختار variant حسب النوع
    if (!empty($product->size_type)) {

        // dimensions: لو مبعتش variant_id اختار أول واحد
        if (($product->size_type ?? 'standard') === 'dimensions') {
            $variant = $variantId
                ? ProductVariant::where('product_id', $product->id)->where('id', $variantId)->first()
                : ProductVariant::where('product_id', $product->id)->orderBy('id')->first();

            abort_if(!$variant, 404);
            $variantId = $variant->id;

        } else {
            // standard: لازم يختار
            $request->validate([
                'variant_id' => ['required','integer'],
            ]);

            $variant = ProductVariant::where('product_id', $product->id)->where('id', $variantId)->first();

            if (!$variant) {
                return $this->currentCart($request);
            }
        }
    }

    
   

    // ✅ السعر: لو variant ليه سعر/خصم استخدمه، وإلا fallback على المنتج
    $unitPrice = (float)($product->price ?? 0);
    $unitSale  = (float)($product->sale_price ?? 0);

    if ($variant) {
        if (!is_null($variant->price))      $unitPrice = (float)$variant->price;
        if (!is_null($variant->sale_price)) $unitSale  = (float)$variant->sale_price;
    }

    $saleToStore = ($unitSale > 0 && $unitSale < $unitPrice) ? $unitSale : null;

    $cart = $this->currentCart($request);

    DB::transaction(function () use ($cart, $product, $variantId, $qty, $unitPrice, $saleToStore, $variant) {

        $item = CartItem::where('cart_id', $cart->id)
            ->where('product_id', $product->id)
            ->where('variant_id', $variantId) 
            ->lockForUpdate()
            ->first();

        if (!$item) {
            CartItem::create([
                'cart_id' => $cart->id,
                'product_id' => $product->id,
                'variant_id' => $variantId,
                'qty' => $qty,
                'unit_price' => $unitPrice,
                'unit_sale_price' => $saleToStore,
            ]);
            return;
        }

        $newQty = $item->qty + $qty;

        if ((int)$product->track_stock === 1) {
            $stock = $variant ? (int)($variant->stock ?? 0) : (int)($product->stock ?? 0);
            $newQty = min($newQty, max(0, $stock));
            if ($newQty < 1) $newQty = 1;
        }

        $item->update([
            'qty' => $newQty,
            'unit_price' => $unitPrice,
            'unit_sale_price' => $saleToStore,
        ]);
    });

    return $cart->fresh('items.product','items.variant');
}


    public function updateQty(Request $request, Product $product, int $qty): Cart
{
    $cart = $this->currentCart($request);
    $qty = max(1, min(999, $qty));

    $variantId = $request->input('variant_id'); // لازم ييجي من الفورم/الزر

    $item = CartItem::where('cart_id', $cart->id)
        ->where('product_id', $product->id)
        ->where('variant_id', $variantId)
        ->firstOrFail();

    // stock check
    if ((int)$product->track_stock === 1) {
        $stock = $item->variant ? (int)($item->variant->stock ?? 0) : (int)($product->stock ?? 0);
        $qty = min($qty, max(1, $stock));
    }

    $item->update(['qty' => $qty]);

    return $cart->fresh('items.product','items.variant');
}


   public function remove(Request $request, Product $product): Cart
{
    $cart = $this->currentCart($request);
    $variantId = $request->input('variant_id');

    CartItem::where('cart_id', $cart->id)
        ->where('product_id', $product->id)
        ->where('variant_id', $variantId)
        ->delete();

    return $cart->fresh('items.product','items.variant');
}


    private function mergeCarts(Cart $from, Cart $to): void
    {
        DB::transaction(function () use ($from, $to) {
            foreach ($from->items as $fromItem) {
                $toItem = CartItem::where('cart_id', $to->id)
  ->where('product_id', $fromItem->product_id)
  ->where('variant_id', $fromItem->variant_id)
  ->first();

                if ($toItem) {
                    $toItem->update(['qty' => $toItem->qty + $fromItem->qty]);
                } else {
                    $fromItem->update(['cart_id' => $to->id]);
                }
            }

            $from->delete();
        });
    }
}
