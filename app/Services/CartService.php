<?php
namespace App\Services;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CartService
{
    public function currentCart(Request $request): Cart
    {
        $userId = auth()->id();
        $sessionId = $request->session()->getId();

        if ($userId) {
            // دمج سلة الضيف عند اللوجين (لو موجودة)
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

        // stock check (اختياري حسب نظامك)
        if ((int)$product->track_stock === 1) {
            $stock = (int)($product->stock ?? 0);
            if ($stock <= 0) {
                return $this->currentCart($request); // أو throw Validation
            }
        }

        $cart = $this->currentCart($request);

        DB::transaction(function () use ($cart, $product, $qty) {
            $item = CartItem::where('cart_id', $cart->id)
                ->where('product_id', $product->id)
                ->lockForUpdate()
                ->first();

            $unitPrice = (float)($product->price ?? 0);
            $unitSale  = (float)($product->sale_price ?? 0);
            $saleToStore = ($unitSale > 0 && $unitSale < $unitPrice) ? $unitSale : null;

            if (!$item) {
                CartItem::create([
                    'cart_id' => $cart->id,
                    'product_id' => $product->id,
                    'qty' => $qty,
                    'unit_price' => $unitPrice,
                    'unit_sale_price' => $saleToStore,
                ]);
                return;
            }

            $newQty = $item->qty + $qty;

            if ((int)$product->track_stock === 1) {
                $stock = (int)($product->stock ?? 0);
                $newQty = min($newQty, max(0, $stock));
                if ($newQty < 1) $newQty = 1;
            }

            $item->update([
                'qty' => $newQty,
                // تحديث snapshot (اختياري)
                'unit_price' => $unitPrice,
                'unit_sale_price' => $saleToStore,
            ]);
        });

        return $cart->fresh('items.product');
    }

    public function updateQty(Request $request, Product $product, int $qty): Cart
    {
        $cart = $this->currentCart($request);
        $qty = max(1, min(999, $qty));

        $item = CartItem::where('cart_id', $cart->id)->where('product_id', $product->id)->firstOrFail();

        if ((int)$product->track_stock === 1) {
            $stock = (int)($product->stock ?? 0);
            $qty = min($qty, max(1, $stock));
        }

        $item->update(['qty' => $qty]);

        return $cart->fresh('items.product');
    }

    public function remove(Request $request, Product $product): Cart
    {
        $cart = $this->currentCart($request);
        CartItem::where('cart_id', $cart->id)->where('product_id', $product->id)->delete();
        return $cart->fresh('items.product');
    }

    private function mergeCarts(Cart $from, Cart $to): void
    {
        DB::transaction(function () use ($from, $to) {
            foreach ($from->items as $fromItem) {
                $toItem = CartItem::where('cart_id', $to->id)->where('product_id', $fromItem->product_id)->first();

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
