<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductReview;
use Illuminate\Http\Request;

class ProductReviewController extends Controller
{
    public function productReviews(Product $product, Request $request)
    {
        $status = $request->get('status', 'all'); // all|pending|approved|hidden
        $q = trim((string)$request->get('q'));

        $reviews = ProductReview::query()
            ->where('product_id', $product->id)
            ->with('user:id,name,email')
            ->when($q !== '', fn($qq) => $qq->where('comment','like',"%{$q}%"))
            ->when($status === 'pending', fn($qq) => $qq->where('is_approved', false))
            ->when($status === 'approved', fn($qq) => $qq->where('is_approved', true)->where('is_visible', true))
            ->when($status === 'hidden', fn($qq) => $qq->where('is_approved', true)->where('is_visible', false))
            ->latest()
            ->paginate(20)
            ->withQueryString();

        $counts = [
            'total'   => ProductReview::where('product_id',$product->id)->count(),
            'pending' => ProductReview::where('product_id',$product->id)->where('is_approved',false)->count(),
            'hidden'  => ProductReview::where('product_id',$product->id)->where('is_approved',true)->where('is_visible',false)->count(),
        ];

        return view('products.reviews', compact('product','reviews','counts','q','status'));
    }

    public function toggleApprove(ProductReview $review)
    {
        $new = !$review->is_approved;
        $review->update([
            'is_approved' => $new,
            'approved_at' => $new ? now() : null,
        ]);

        return back()->with('success', 'Updated');
    }

    public function toggleVisible(ProductReview $review)
    {
        $review->update(['is_visible' => !$review->is_visible]);
        return back()->with('success', 'Updated');
    }

    public function destroy(ProductReview $review)
    {
        $review->delete();
        return back()->with('success', 'Deleted');
    }
}
