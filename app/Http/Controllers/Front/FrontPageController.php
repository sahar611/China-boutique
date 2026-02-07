<?php

namespace App\Http\Controllers\Front;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Brand;
use App\Models\News;
use App\Models\Faq;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use App\Models\Product;
class FrontPageController extends Controller
{
    public function allCategories(Request $request)
    {
        $q = trim((string) $request->get('q'));

        $categories = Category::query()
           
            ->when(\Schema::hasColumn('categories', 'is_active'), function ($query) {
                $query->where('is_active', 1);
            })
            ->when($q !== '', function ($query) use ($q) {
                $query->where(function ($w) use ($q) {
                    $w->where('name_ar', 'like', "%{$q}%")
                      ->orWhere('name_en', 'like', "%{$q}%");
                });
            })
            ->orderBy('id', 'desc')
            ->paginate(18) 
            ->withQueryString(); 

        return view('front.categories', compact('categories', 'q'));
    }
    public function allBrands(Request $request)
    {
        $q = trim((string) $request->get('q'));

        $brands = Brand::query()
    ->when(Schema::hasColumn('brands', 'is_active'), fn($q) => $q->where('is_active', 1))
    ->withCount([
        'products as products_count' => function ($q) {
            $q->where('is_active', 1); 
        }
    ])
    ->when($q !== '', function ($query) use ($q) {
        $query->where(function ($w) use ($q) {
            $w->where('name_ar', 'like', "%{$q}%")
              ->orWhere('name_en', 'like', "%{$q}%");
        });
    })
    ->orderBy('id', 'desc')
    ->paginate(4)
    ->withQueryString();

        return view('front.brands', compact('brands', 'q'));
    }
     public function blogs()
    {
        $news = News::query()
            ->where('is_published', 1)
            ->orderByDesc('published_at')   
            ->paginate(12);

        return view('front.blogs', compact('news'));
    }
    public function showBlog($slug)
    {
        $item = News::where('is_published', 1)
            ->where('slug', $slug)
            ->firstOrFail();

       
       
        return view('front.show_blog_details', compact('item'));
    }
    public function faqs()
    {
        $faqs = Faq::active()
            ->orderBy('sort_order')
            ->orderByDesc('id')
            ->get();

        return view('front.faqs', compact('faqs'));
    }
     public function trending(Request $request)
{
    $q = trim((string) $request->get('q')); 
    $trendingNow = Product::query()
        ->whereJsonContains('positions', 'trending')
        ->when($q, function ($query) use ($q) {
            $query->where(function ($qq) use ($q) {
                $qq->where('name_ar', 'like', "%{$q}%")
                   ->orWhere('name_en', 'like', "%{$q}%")
                   ->orWhere('sku', 'like', "%{$q}%");
            });
        })
        ->latest()            
        ->paginate(18)
        ->withQueryString();

    return view('front.trending', compact('trendingNow', 'q'));
}

}
