<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Services\CurrencyService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use App\Models\ProductReview;
class FrontProductController extends Controller
{
    /* =========================
       Helpers
       ========================= */

  private function currencyData(): array
{
    $currency = session('currency') ?? CurrencyService::current();

    $rate = 1.0;
    $symbol = 'SAR'; 

    if (is_object($currency)) {
        if (isset($currency->rate) && (float) $currency->rate > 0) {
            $rate = (float) $currency->rate;
        }
        if (isset($currency->symbol) && $currency->symbol) {
            $symbol = (string) $currency->symbol;
        } elseif (isset($currency->code) && $currency->code) {
            $symbol = (string) $currency->code;
        }
    } elseif (is_array($currency)) {
        if (isset($currency['rate']) && (float) $currency['rate'] > 0) {
            $rate = (float) $currency['rate'];
        }
        if (!empty($currency['symbol'])) {
            $symbol = (string) $currency['symbol'];
        } elseif (!empty($currency['code'])) {
            $symbol = (string) $currency['code'];
        }
    } elseif (is_string($currency) && $currency !== '') {

        $symbol = $currency;
    }

    return [$currency, $rate, $symbol];
}


    private function categoriesList()
    {
        return Category::query()
            ->where('is_active', 1)
            ->withCount(['products as products_count' => fn($q) => $q->where('is_active', 1)])
            ->orderBy('home_sort')
            ->orderBy('sort_order')
            ->get(['id', 'name_ar', 'name_en', 'slug']);
    }

    private function brandsList()
    {
        return Brand::query()
            ->when(Schema::hasColumn('brands', 'is_active'), fn($q) => $q->where('is_active', 1))
            ->withCount(['products as products_count' => fn($q) => $q->where('is_active', 1)])
            ->orderBy('home_sort')
            ->orderBy('sort_order')
            ->get(['id', 'name_ar', 'name_en', 'slug', 'logo']);
    }

    private function productRelations(): array
    {
        return [
            'images' => function ($q) {
                $q->orderByDesc('is_main')->orderBy('sort_order');
            },
            'brand:id,name_en,name_ar,slug,logo',
            'category:id,name_en,name_ar,slug',
        ];
    }

    private function normalizePriceRange(?string $from, ?string $to, float $rate): array
    {
        $priceFrom = is_numeric($from) ? max(0, (float)$from) : null;
        $priceTo   = is_numeric($to) ? max(0, (float)$to) : null;

        if (!is_null($priceFrom) && !is_null($priceTo) && $priceFrom > $priceTo) {
            [$priceFrom, $priceTo] = [$priceTo, $priceFrom];
        }

        $safeRate = max($rate, 0.0000001);

        $baseFrom = !is_null($priceFrom) ? ($priceFrom / $safeRate) : null;
        $baseTo   = !is_null($priceTo)   ? ($priceTo / $safeRate) : null;

        return [$priceFrom, $priceTo, $baseFrom, $baseTo];
    }

    /**
     * Build common filter values from request (supports arrays for checkboxes).
     */
    private function readFilters(Request $request): array
    {
        $q    = trim((string) $request->get('q'));
        $sort = (string) $request->get('sort', 'new');

        // checkbox arrays (category_ids[] , brand_ids[])
        $categoryIds = array_values(array_filter((array) $request->get('category_ids', [])));
        $brandIds    = array_values(array_filter((array) $request->get('brand_ids', [])));

        // support single dropdown category_id if you ever use it
        $categoryId = $request->get('category_id');
        if (!empty($categoryId) && empty($categoryIds)) {
            $categoryIds = [(int) $categoryId];
        }

        return [$q, $sort, $categoryIds, $brandIds];
    }

    /**
     * Apply search/category/brand/price filters + sort.
     */
    private function applyFiltersAndSort($query, string $q, array $categoryIds, array $brandIds, ?float $baseFrom, ?float $baseTo, string $sort)
    {
        $effectivePriceSql = "COALESCE(NULLIF(sale_price,0), price)";

        $query
            ->when($q !== '', function ($query) use ($q) {
                $query->where(function ($w) use ($q) {
                    $w->where('name_ar', 'like', "%{$q}%")
                      ->orWhere('name_en', 'like', "%{$q}%");
                });
            })
            ->when(!empty($categoryIds), fn($query) => $query->whereIn('category_id', $categoryIds))
            ->when(!empty($brandIds), fn($query) => $query->whereIn('brand_id', $brandIds))
            ->when(!is_null($baseFrom), fn($query) => $query->whereRaw("$effectivePriceSql >= ?", [$baseFrom]))
            ->when(!is_null($baseTo), fn($query) => $query->whereRaw("$effectivePriceSql <= ?", [$baseTo]));

        if ($sort === 'price_desc') {
            $query->orderByRaw("$effectivePriceSql DESC");
        } elseif ($sort === 'price_asc') {
            $query->orderByRaw("$effectivePriceSql ASC");
        } else {
            $query->latest();
        }

        return $query;
    }

    private function baseViewData(Request $request, $model, string $pageType, string $pageTitle): array
    {
        [$currency, $rate] = $this->currencyData();
        [$q, $sort, $categoryIds, $brandIds] = $this->readFilters($request);

        [$priceFrom, $priceTo, $baseFrom, $baseTo] = $this->normalizePriceRange(
            $request->get('from'),
            $request->get('to'),
            $rate
        );

        return [
            'model'       => $model,
            'pageType'    => $pageType,
            'pageTitle'   => $pageTitle,

            'currency'    => $currency,
            'rate'        => $rate,

            'categories'  => $this->categoriesList(),
            'brands'      => $this->brandsList(),

            'q'           => $q,
            'sort'        => $sort,
            'priceFrom'   => $priceFrom,
            'priceTo'     => $priceTo,

            // arrays for checkboxes
            'categoryIds' => $categoryIds,
            'brandIds'    => $brandIds,

            // base prices (internal use)
            '_baseFrom'   => $baseFrom,
            '_baseTo'     => $baseTo,
        ];
    }

    /* =========================
       Pages
       ========================= */

    public function byCategory(string $slug, Request $request)
    {
        $model = Category::query()
            ->where('slug', $slug)
            ->where('is_active', 1)
            ->firstOrFail();

        $data = $this->baseViewData(
            $request,
            $model,
            'category',
            app()->getLocale() === 'ar' ? $model->name_ar : $model->name_en
        );

        $query = Product::query()
            ->where('is_active', 1)
            ->where('category_id', $model->id)
            ->with($this->productRelations());

        // لو حابب تسيب البحث/السعر/السورت شغالين حتى داخل category page:
        $this->applyFiltersAndSort(
            $query,
            $data['q'],
            [$model->id],           // forced category
            $data['brandIds'],      // allow brand filter
            $data['_baseFrom'],
            $data['_baseTo'],
            $data['sort']
        );

        $data['products'] = $query->paginate(12)->withQueryString();

        // نظافة: لا نرسل private keys للـ view
        unset($data['_baseFrom'], $data['_baseTo']);

        return view('front.products', $data);
    }

    public function byBrand(string $slug, Request $request)
    {
        $model = Brand::query()
            ->where('slug', $slug)
            ->when(Schema::hasColumn('brands', 'is_active'), fn($q) => $q->where('is_active', 1))
            ->firstOrFail();

        $data = $this->baseViewData(
            $request,
            $model,
            'brand',
            app()->getLocale() === 'ar' ? $model->name_ar : $model->name_en
        );

        $query = Product::query()
            ->where('is_active', 1)
            ->where('brand_id', $model->id)
            ->with($this->productRelations());

        // allow category filter + price + sort داخل brand page
        $this->applyFiltersAndSort(
            $query,
            $data['q'],
            $data['categoryIds'],
            [$model->id],          // forced brand
            $data['_baseFrom'],
            $data['_baseTo'],
            $data['sort']
        );

        $data['products'] = $query->paginate(12)->withQueryString();

        unset($data['_baseFrom'], $data['_baseTo']);

        return view('front.products', $data);
    }

    public function allProducts(Request $request)
    {
        $data = $this->baseViewData(
            $request,
            null,
            'all',
            __('All Products')
        );

        $query = Product::query()
            ->where('is_active', 1)
            ->with($this->productRelations());

        $this->applyFiltersAndSort(
            $query,
            $data['q'],
            $data['categoryIds'],
            $data['brandIds'],
            $data['_baseFrom'],
            $data['_baseTo'],
            $data['sort']
        );

        $data['products'] = $query->paginate(12)->withQueryString();

        unset($data['_baseFrom'], $data['_baseTo']);

        return view('front.products', $data);
    }
    public function showDetails(string $slug, Request $request)
    {
        [$currency, $rate, $symbol] = $this->currencyData();

        $product = Product::query()
            ->where('is_active', 1)
            ->where('slug', $slug)
            ->with([
                'images' => fn($q) => $q->orderByDesc('is_main')->orderBy('sort_order'),
                'brand:id,name_ar,name_en,slug,logo',
                'category:id,name_ar,name_en,slug',
            ])
            ->firstOrFail();

        // ===== Prices in current currency =====
        $basePrice = (float)($product->price ?? 0);
        $baseSale  = (float)($product->sale_price ?? 0);

        $hasSale = $baseSale > 0 && $baseSale < $basePrice;
        $finalBase = $hasSale ? $baseSale : $basePrice;

        $price = $finalBase * $rate;
        $oldPrice = $hasSale ? ($basePrice * $rate) : null;

        // discount percent (optional)
        $discountPercent = null;
        if ($hasSale && $basePrice > 0) {
            $discountPercent = (int) round((($basePrice - $baseSale) / $basePrice) * 100);
        }

        // ===== Main image + gallery =====
        $mainImage = $product->images->first(); 
        $gallery   = $product->images;

        // ===== Related products (same category) =====
        $related = Product::query()
            ->where('is_active', 1)
            ->where('id', '!=', $product->id)
            ->where('category_id', $product->category_id)
            ->with([
                'images' => fn($q) => $q->orderByDesc('is_main')->orderBy('sort_order'),
                'brand:id,name_ar,name_en,slug',
            ])
            ->latest()
            ->limit(8)
            ->get();

       
    
        $reviews = $product->visibleReviews()->latest()->paginate(10);
$reviewsCount = $product->visibleReviews()->count();
$avgRating = (float) $product->visibleReviews()->avg('rating');


        return view('front.product-show', compact(
            'product',
            'mainImage',
            'gallery',
            'related',
            'currency',
            'rate',
            'symbol',
            'price',
            'oldPrice',
            'hasSale',
            'discountPercent',
             'reviews','reviewsCount','avgRating'
        ));
    }
    public function storeReview(Request $request, Product $product)
    {
        $data = $request->validate([
            'rating'  => ['required','integer','min:1','max:5'],
            'comment' => ['required','string','min:3','max:2000'],

          
            'name'  => ['nullable','string','max:100'],
            'email' => ['nullable','email','max:150'],
        ]);

       
        ProductReview::create([
            'product_id' => $product->id,
            'user_id'    => auth()->id(),
            'name'       => $data['name'] ?? null,
            'email'      => $data['email'] ?? null,
            'rating'     => $data['rating'],
            'comment'    => $data['comment'],
            'is_approved'=> false, 
            'is_visible' => true,
            'ip'         => $request->ip(),
            'user_agent' => substr((string)$request->userAgent(), 0, 255),
        ]);

        return back()->with('success', __('home.review_sent_success')); 
    }
}
