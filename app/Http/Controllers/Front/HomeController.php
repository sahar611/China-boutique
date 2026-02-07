<?php

namespace App\Http\Controllers\Front;
use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Currency;
use App\Models\HomeBanner;
use App\Models\WorkStep;
use App\Models\Page;
use App\Models\NewsletterSubscriber;

class HomeController extends Controller
{
        private array $allowed = ['en', 'ar'];

    public function index(Request $request)
    {
       
        $headerDropdownCategories = Category::query()
            ->where('is_active', 1)
            ->where('is_featured', 1)
             ->whereJsonContains('positions', 'header_dropdown')
            ->orderBy('home_sort')
            ->orderBy('sort_order')
            ->limit(10)
            ->get();

        $homeSidebarCategories = Category::query()
            ->where('is_active', 1)
            ->where('is_featured', 1)
            ->whereJsonContains('positions', 'home_sidebar')
            ->orderBy('home_sort')
            ->orderBy('sort_order')
            ->limit(10)
            ->get();

        // Top Categories section (Browse Top Category)
        $topCategories = Category::query()
            ->where('is_active', 1)
            ->where('is_featured', 1)
           
             ->whereJsonContains('positions', 'home_top_categories')
            ->orderBy('home_sort')
            ->orderBy('sort_order')
            ->limit(12)
            ->get();

        // Home Tabs categories (Women / Shirts / ...)
        $homeTabsCategories = Category::query()
            ->where('is_active', 1)
            ->where('is_featured', 1)
            
             ->whereJsonContains('positions', 'home_tabs')
            ->orderBy('home_sort')
            ->orderBy('sort_order')
            ->limit(12)
            ->get();


        // ==============
        // 2) Brands Section (Browse Top Brands)
        // ==============
       
$topBrands = Brand::query()
    ->where('is_active', 1)
    ->where('is_featured', 1)
    ->withCount([
        'products' => function ($q) {
            $q->where('is_active', 1);
        }
    ])
    ->orderBy('home_sort')
    ->orderBy('sort_order')
    ->limit(6)
    ->get();


            $heroBanner = Banner::query()
                ->where('status', 1)
                ->orderBy('id')
                ->get();



       
       $baseProducts = Product::query()
            ->where('is_active', 1)
            ->with([
                'images' => function ($q) {
                    $q->orderByDesc('is_main')->orderBy('sort_order');
                },
                'brand:id,name_en,name_ar,slug,logo',
                'category:id,name_en,name_ar,slug,image',
            ]);

        // Features Collection (Our Features Collection)
        $featuresCollection = (clone $baseProducts)
            ->whereJsonContains('positions', 'features_collection')
            ->orderBy('home_sort')
            ->latest()
            ->limit(8)
            ->get();

        // Our Products
        $homeProducts = (clone $baseProducts)
            ->whereJsonContains('positions', 'home_products')
            ->orderBy('home_sort')
            ->latest()
            ->limit(8)
            ->get();

        // Trending Now
        $trendingNow = (clone $baseProducts)
            ->whereJsonContains('positions', 'trending')
            ->orderBy('home_sort')
            ->latest()
            ->limit(8)
            ->get();

        // Optional: Sidebar deals / header_menu / home_top
        $sidebarDeals = (clone $baseProducts)
            ->whereJsonContains('positions', 'sidebar_deals')
            ->orderBy('home_sort')
            ->latest()
            ->limit(6)
            ->get();

        $homeTopProducts = (clone $baseProducts)
            ->whereJsonContains('positions', 'home_top')
            ->orderBy('home_sort')
            ->latest()
            ->limit(10)
            ->get();
$bestSellers = (clone $baseProducts)
            ->whereJsonContains('positions', 'best_sellers')   
             ->with('mainImageProduct')
            ->orderBy('home_sort')
            ->latest()
            ->limit(8)
            ->get();

        // ✅ New Products
        $newProducts = (clone $baseProducts)
            ->whereJsonContains('positions', 'new_products')   
            ->orderBy('home_sort')
            ->latest()
            ->limit(8)
            ->get();

        // ✅ Sale Products
        $saleProducts = (clone $baseProducts)
            ->whereJsonContains('positions', 'sale_products')  
            ->orderBy('home_sort')
            ->latest()
            ->limit(8)
            ->get();
        // ==============
        // 5) Optional: Tabs products per category (لو عايز لكل تاب يعرض منتجات)
        // ==============
        // مثال: نجيب منتجات لكل كاتيجوري من home_tabs
        // علشان الأداء: هنجيب دفعة واحدة ثم نجمعها
        $tabCategoryIds = $homeTabsCategories->pluck('id')->values()->all();

        $tabProducts = collect();
        if (!empty($tabCategoryIds)) {
            $tabProducts = Product::query()
                ->where('is_active', 1)
                ->whereIn('category_id', $tabCategoryIds)
                ->with([
                    'images' => function ($q) {
                        $q->orderByDesc('is_main')->orderBy('sort_order');
                    }
                ])
                ->latest()
                ->limit(60)
                ->get()
                ->groupBy('category_id');
        }
$promoBanners = HomeBanner::query()
    ->where('is_active', 1)
    ->where('position', 'promo_section')
    ->orderBy('sort_order')
    ->limit(2)
    ->get();
$workSteps = WorkStep::query()
    ->where('is_active',1)
    ->orderBy('sort_order')
    ->limit(4)
    ->get();
        return view('front.home', [
            'heroBanner' => $heroBanner,

            'headerDropdownCategories' => $headerDropdownCategories,
            'homeSidebarCategories'    => $homeSidebarCategories,
            'topCategories'            => $topCategories,
            'homeTabsCategories'       => $homeTabsCategories,

            'topBrands'                => $topBrands,

            'featuresCollection'       => $featuresCollection,
            'homeProducts'             => $homeProducts,
            'trendingNow'              => $trendingNow,
            'sidebarDeals'             => $sidebarDeals,
            'homeTopProducts'          => $homeTopProducts,
            'bestSellers'          => $bestSellers,
            'saleProducts'          => $saleProducts,
            'newProducts'          => $newProducts,
            'promoBanners' => $promoBanners,
            'tabProducts'              => $tabProducts,
             'workSteps'              => $workSteps,
        ]);
    }
     public function changeCurrency(string $code)
    {
        $currency = Currency::where('code', $code)
            ->where('is_active', 1)
            ->firstOrFail();

        session(['currency' => $currency]);

        return back();
    }

    public function changeLang(Request $request, string $locale)
    {
        $locale = strtolower($locale);

        abort_unless(in_array($locale, $this->allowed, true), 404);

        session(['locale' => $locale]);

        return back();
    }
    public function subscribe(Request $request)
  {
    $data = $request->validate([
      'email' => ['required','email','max:255'],
    ]);

    $subscriber = NewsletterSubscriber::firstOrCreate(
      ['email' => strtolower($data['email'])],
      [
        'locale' => app()->getLocale(),
        'ip' => $request->ip(),
        'subscribed_at' => now(),
        'is_active' => 1
      ]
    );

    if (!$subscriber->is_active) {
      $subscriber->update([
        'is_active' => 1,
        'subscribed_at' => now(),
      ]);
    }
 if ($subscriber->wasRecentlyCreated) {
    Mail::to($subscriber->email)->queue(new NewsletterWelcomePromoMail($subscriber));
}
    return back()->with('newsletter_success', __('home.newsletter_success'));
  }
  public function showPage($slug)
    {
        $page = Page::where('slug', $slug)
            ->firstOrFail();

        return view('front.page', compact('page'));
    }
   
}
