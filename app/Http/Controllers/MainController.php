<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:dashboard.view')->only('index');
    }

    public function index(Request $request)
    {
        $lowStockThreshold = (int) (config('shop.low_stock_threshold') ?? 5);

        $totalProducts     = Product::count();
        $activeProducts    = Product::where('is_active', 1)->count();
        $inactiveProducts  = Product::where('is_active', 0)->count();

        $outOfStock        = Product::where('track_stock', 1)->where('stock', 0)->count();
        $lowStock          = Product::where('track_stock', 1)->whereBetween('stock', [1, $lowStockThreshold])->count();

        $totalCategories   = Category::count();
        $totalBrands       = Brand::count();

        $latestProducts = Product::with(['category:id,name_en,name_ar', 'brand:id,name_en,name_ar'])
            ->latest('id')
            ->take(8)
            ->get();

        $lowStockProducts = Product::with(['category:id,name_en,name_ar', 'brand:id,name_en,name_ar'])
            ->where('track_stock', 1)
            ->where('stock', '>', 0)
            ->where('stock', '<=', $lowStockThreshold)
            ->orderBy('stock', 'asc')
            ->take(8)
            ->get();

        $outOfStockProducts = Product::with(['category:id,name_en,name_ar', 'brand:id,name_en,name_ar'])
            ->where('track_stock', 1)
            ->where('stock', 0)
            ->latest('id')
            ->take(8)
            ->get();

        return view('dashboard.index', compact(
            'lowStockThreshold',
            'totalProducts',
            'activeProducts',
            'inactiveProducts',
            'outOfStock',
            'lowStock',
            'totalCategories',
            'totalBrands',
            'latestProducts',
            'lowStockProducts',
            'outOfStockProducts'
        ));
    }
}
