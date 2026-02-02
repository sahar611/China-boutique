<?php
namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    private function sessionKey(): string
    {
        return 'wishlist'; // array of product_ids
    }

    public function index()
    {
        if (Auth::check()) {
            $products = Auth::user()->wishlistProducts()->latest('wishlists.created_at')->paginate(12);
            $count = Auth::user()->wishlistProducts()->count();
        } else {
            $ids = session($this->sessionKey(), []);
            $products = Product::whereIn('id', $ids)->latest()->paginate(12);
            $count = count($ids);
        }

        return view('front.wishlist', compact('products', 'count'));
    }

   

    public function toggle(Request $request, Product $product)
{
    try {
        if (Auth::check()) {
            $exists = Wishlist::where('user_id', Auth::id())
                ->where('product_id', $product->id)
                ->exists();

            if ($exists) {
                Wishlist::where('user_id', Auth::id())
                    ->where('product_id', $product->id)
                    ->delete();

                $count = Wishlist::where('user_id', Auth::id())->count();

                return response()->json([
                    'ok'      => true,
                    'status'  => 'removed',
                    'count'   => $count,
                    'message' => __('home.removed_from_wishlist'),
                ]);
            }

            Wishlist::create([
                'user_id' => Auth::id(),
                'product_id' => $product->id,
            ]);

            $count = Wishlist::where('user_id', Auth::id())->count();

            return response()->json([
                'ok'      => true,
                'status'  => 'added',
                'count'   => $count,
                'message' => __('home.added_to_wishlist'),
            ]);
        }

        // Guest
        $ids = session($this->sessionKey(), []);
        $ids = is_array($ids) ? $ids : [];

        if (in_array($product->id, $ids)) {
            $ids = array_values(array_diff($ids, [$product->id]));
            session([$this->sessionKey() => $ids]);

            return response()->json([
                'ok'      => true,
                'status'  => 'removed',
                'count'   => count($ids),
                'message' => __('home.removed_from_wishlist'),
            ]);
        }

        $ids[] = $product->id;
        $ids = array_values(array_unique($ids));
        session([$this->sessionKey() => $ids]);

        return response()->json([
            'ok'      => true,
            'status'  => 'added',
            'count'   => count($ids),
            'message' => __('home.added_to_wishlist'),
        ]);

    } catch (\Throwable $e) {
        return response()->json([
            'ok' => false,
            'message' => __('home.wishlist_failed'),
        ], 500);
    }
}


    public function remove(Product $product)
    {
        if (Auth::check()) {
            Wishlist::where('user_id', Auth::id())
                ->where('product_id', $product->id)
                ->delete();
        } else {
            $ids = session($this->sessionKey(), []);
            $ids = is_array($ids) ? $ids : [];
            $ids = array_values(array_diff($ids, [$product->id]));
            session([$this->sessionKey() => $ids]);
        }

      return response()->json([
    'status'  => 'removed',
    'count'   => Auth::check()
        ? Wishlist::where('user_id', Auth::id())->count()
        : count(session($this->sessionKey(), [])),
    'message' => __('home.removed_from_wishlist'),
]);

    }

    private function getWishlistData(): array
    {
        if (Auth::check()) {
            $products = Auth::user()->wishlistProducts()
                ->latest('wishlists.created_at')
                ->take(8)->get();
            $count = Auth::user()->wishlistProducts()->count();
            return [$products, $count];
        }

        $ids = session($this->sessionKey(), []);
        $ids = is_array($ids) ? $ids : [];
        $products = Product::whereIn('id', $ids)->take(8)->get();
        $count = count($ids);

        return [$products, $count];
    }
}
