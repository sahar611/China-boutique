<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use App\Support\GeneratesUniqueSlug;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Support\UploadsToPublic;

class ProductController extends Controller
{
    use GeneratesUniqueSlug;    
    use UploadsToPublic;

public function __construct()
{
    $this->middleware('permission:products.view')->only(['index','show']);
    $this->middleware('permission:products.create')->only(['create','store']);
    $this->middleware('permission:products.edit')->only(['edit','update']);
    $this->middleware('permission:products.delete')->only(['destroy']);

    $this->middleware('permission:products.publish')->only(['publish']);
    $this->middleware('permission:products.unpublish')->only(['unpublish']);

    $this->middleware('permission:products.price_edit')->only(['editPrice','updatePrice']);
    $this->middleware('permission:products.stock_edit')->only(['editStock','updateStock']);

    $this->middleware('permission:products.images_manage')->only([
        'setMainImage','destroyImage'
    ]);
    $this->middleware('permission:products.publish|products.unpublish|products.delete')->only(['bulk']);

}

    public function index(Request $request)
{
    $products = Product::with(['category','brand'])
        ->when($request->q, function ($q) use ($request) {
            $term = trim($request->q);
            $q->where(function ($qq) use ($term) {
                $qq->where('name_en', 'like', "%{$term}%")
                   ->orWhere('name_ar', 'like', "%{$term}%")
                   ->orWhere('sku', 'like', "%{$term}%");
            });
        })
        ->when($request->category_id, fn($q) => $q->where('category_id', $request->category_id))
        ->when($request->brand_id, fn($q) => $q->where('brand_id', $request->brand_id))
        ->when($request->status !== null && $request->status !== '', fn($q) => $q->where('is_active', (int)$request->status))
        ->when($request->stock_filter === 'out', fn($q) => $q->where('stock', 0))
        ->when($request->stock_filter === 'low', fn($q) => $q->whereBetween('stock', [1, 5]))
        ->latest()
        ->paginate(20)
        ->withQueryString();

    $categories = Category::orderBy('sort_order')->get(['id','name_en','name_ar']);
    $brands     = Brand::orderBy('sort_order')->get(['id','name_en','name_ar']);

    return view('products.index', compact('products','categories','brands'));
}


    public function create()
    {
        $categories = Category::where('is_active',1)->orderBy('sort_order')->get();
        $brands = Brand::where('is_active',1)->orderBy('sort_order')->get();

        return view('products.create', compact('categories','brands'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'category_id'     => ['required','exists:categories,id'],
            'brand_id'        => ['required','exists:brands,id'],
            'name_en'         => ['required','string','max:255'],
            'name_ar'         => ['required','string','max:255'],
            'description_en'  => ['nullable','string'],
            'description_ar'  => ['nullable','string'],
            'price'           => ['required','numeric','min:0'],
            'sale_price'      => ['nullable','numeric','min:0'],
            'stock'           => ['nullable','integer','min:0'],
            'track_stock'     => ['required','boolean'],
            'sku'             => ['nullable','string','max:255','unique:products,sku'],
            'is_active'       => ['required','boolean'],

          
            'images.*'        => ['nullable','image','mimes:jpg,jpeg,png,webp','max:4096'],
            'main_image'      => ['nullable','integer','min:0'], 
        ]);

        $data['slug'] = $this->generateUniqueSlug(Product::class, $data['name_en']);
        $data['stock'] = $data['stock'] ?? 0;

        $product = Product::create($data);

       
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $i => $file) {
                ProductImage::create([
                    'product_id' => $product->id,
                    'path' => $this->uploadFile($file, 'products'),
                    'is_main' => $i === 0,
                    'sort_order' => $i,
                ]);
            }
        }

        return redirect()->route('admin.products.index')->with('success', __('messages.saved_successfully'));
    }

    public function edit(Product $product)
    {
        $product->load('images');
        $categories = Category::orderBy('sort_order')->get();
        $brands = Brand::orderBy('sort_order')->get();

        return view('products.edit', compact('product','categories','brands'));
    }

    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'category_id'     => ['required','exists:categories,id'],
            'brand_id'        => ['required','exists:brands,id'],
            'name_en'         => ['required','string','max:255'],
            'name_ar'         => ['required','string','max:255'],
            'description_en'  => ['nullable','string'],
            'description_ar'  => ['nullable','string'],
            'price'           => ['required','numeric','min:0'],
            'sale_price'      => ['nullable','numeric','min:0'],
            'stock'           => ['nullable','integer','min:0'],
            'track_stock'     => ['required','boolean'],
            'sku'             => ['nullable','string','max:255','unique:products,sku,' . $product->id],
            'is_active'       => ['required','boolean'],

            
            'images.*'        => ['nullable','image','mimes:jpg,jpeg,png,webp','max:4096'],
            'main_image'      => ['nullable','integer','min:0'],
        ]);

        if ($data['name_en'] !== $product->name_en) {
            $data['slug'] = $this->generateUniqueSlug(Product::class, $data['name_en'], $product->id);
        }

        $data['stock'] = $data['stock'] ?? 0;

        $product->update($data);

        // صور جديدة (لا نحذف القديمة هنا)
        if ($request->hasFile('images')) {
            $existingCount = $product->images()->count();
            $mainIndex = (int) ($request->input('main_image', 0));

            foreach ($request->file('images') as $i => $file) {
                $path = $file->store('products', 'public');
                ProductImage::create([
                    'product_id' => $product->id,
                    'path' => $path,
                    'is_main' => ($existingCount === 0 && $i === $mainIndex), // لو مفيش صور قديمة
                    'sort_order' => $existingCount + $i,
                ]);
            }
        }

        return redirect()->route('admin.products.index')->with('success', __('messages.updated_successfully'));
    }

    public function destroy(Product $product)
    {
       
      foreach ($product->images as $img) {
        $this->deleteFile($img->path);
    }

    $product->delete();

        return redirect()->route('admin.products.index')->with('success', __('messages.deleted_successfully'));
    }
    public function destroyImage(Product $product, ProductImage $image)
{
    abort_if($image->product_id !== $product->id, 404);

    $this->deleteFile($image->path);
    $image->delete();
    if ($wasMain) {
        $first = $product->images()->orderBy('sort_order')->first();
        if ($first) {
            $first->update(['is_main' => true]);
        }
    }

    return back()->with('success', __('messages.deleted_successfully'));
}

public function setMainImage(Product $product, ProductImage $image)
{
    abort_if($image->product_id !== $product->id, 404);

    
    $product->images()->update(['is_main' => false]);
    $image->update(['is_main' => true]);

    return back()->with('success', __('messages.updated_successfully'));
}
public function editPrice(Product $product)
{
    return view('products.price', compact('product'));
}

public function updatePrice(Request $request, Product $product)
{
    $data = $request->validate([
        'price' => ['required','numeric','min:0'],
        'sale_price' => ['nullable','numeric','min:0'],
    ]);

    $product->update($data);

    return redirect()->route('admin.products.index')
        ->with('success', __('messages.updated_successfully'));
}
public function editStock(Product $product)
{
    return view('products.stock', compact('product'));
}

public function updateStock(Request $request, Product $product)
{
    $data = $request->validate([
        'stock' => ['required','integer','min:0'],
        'track_stock' => ['required','boolean'],
    ]);

    $product->update($data);

    return redirect()->route('admin.products.index')
        ->with('success', __('messages.updated_successfully'));
}
public function publish(Product $product)
{
    $product->update(['is_active' => 1]);
    return back()->with('success', __('messages.updated_successfully'));
}

public function unpublish(Product $product)
{
    $product->update(['is_active' => 0]);
    return back()->with('success', __('messages.updated_successfully'));
}

public function bulk(Request $request)
{
    $data = $request->validate([
        'action' => ['required', 'in:publish,unpublish,delete'],
        'ids' => ['required', 'array'],
        'ids.*' => ['integer', 'exists:products,id'],
    ]);

    $ids = $data['ids'];

    if ($data['action'] === 'publish') {
        $this->authorizeBulkPermission('products.publish');
        Product::whereIn('id', $ids)->update(['is_active' => 1]);
        return back()->with('success', __('messages.updated_successfully'));
    }

    if ($data['action'] === 'unpublish') {
        $this->authorizeBulkPermission('products.unpublish');
        Product::whereIn('id', $ids)->update(['is_active' => 0]);
        return back()->with('success', __('messages.updated_successfully'));
    }

    // delete
    $this->authorizeBulkPermission('products.delete');

    $products = Product::with('images')->whereIn('id', $ids)->get();
    foreach ($products as $product) {
       
        foreach ($product->images as $img) {
            if ($img->path && file_exists(public_path($img->path))) {
                unlink(public_path($img->path));
            }
        }
        $product->delete();
    }

    return back()->with('success', __('messages.deleted_successfully'));
}


protected function authorizeBulkPermission(string $permission): void
{
    abort_unless(auth()->user()->can($permission), 403);
}


}
