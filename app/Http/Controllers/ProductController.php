<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use App\Support\GeneratesUniqueSlug;
use App\Support\UploadsToPublic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class ProductController extends Controller
{
    use GeneratesUniqueSlug;
    use UploadsToPublic;

    public function __construct()
    {
        $this->middleware('permission:products.view')->only(['index', 'show']);
        $this->middleware('permission:products.create')->only(['create', 'store', 'duplicate']);
        $this->middleware('permission:products.edit')->only(['edit', 'update']);
        $this->middleware('permission:products.delete')->only(['destroy']);

        $this->middleware('permission:products.publish')->only(['publish']);
        $this->middleware('permission:products.unpublish')->only(['unpublish']);

        $this->middleware('permission:products.price_edit')->only(['editPrice', 'updatePrice']);
        $this->middleware('permission:products.stock_edit')->only(['editStock', 'updateStock']);

        $this->middleware('permission:products.images_manage')->only(['setMainImage', 'destroyImage']);

        $this->middleware('permission:products.publish|products.unpublish|products.delete')->only(['bulk']);
    }

    public function index(Request $request)
    {
        $products = Product::with(['category', 'brand'])
            ->when($request->q, function ($q) use ($request) {
                $term = trim($request->q);
                $q->where(function ($qq) use ($term) {
                    $qq->where('name_en', 'like', "%{$term}%")
                        ->orWhere('name_ar', 'like', "%{$term}%")
                        ->orWhere('sku', 'like', "%{$term}%");
                });
            })
            ->when($request->category_id, fn ($q) => $q->where('category_id', $request->category_id))
            ->when($request->brand_id, fn ($q) => $q->where('brand_id', $request->brand_id))
            ->when($request->status !== null && $request->status !== '', fn ($q) => $q->where('is_active', (int) $request->status))
            ->when($request->stock_filter === 'out', fn ($q) => $q->where('stock', 0))
            ->when($request->stock_filter === 'low', fn ($q) => $q->whereBetween('stock', [1, 5]))
              ->withCount([
      'reviews as reviews_total_count',
      'reviews as reviews_pending_count' => fn($q) => $q->where('is_approved', false),
      'reviews as reviews_hidden_count'  => fn($q) => $q->where('is_approved', true)->where('is_visible', false),
  ])
            ->latest()
            ->paginate(20)
            ->withQueryString();

        $categories = Category::orderBy('sort_order')->get(['id', 'name_en', 'name_ar']);
        $brands     = Brand::orderBy('sort_order')->get(['id', 'name_en', 'name_ar']);

        return view('products.index', compact('products', 'categories', 'brands'));
    }

    public function create()
    {
        $categories = Category::where('is_active', 1)->orderBy('sort_order')->get();
        $brands     = Brand::where('is_active', 1)->orderBy('sort_order')->get();

        return view('products.create', compact('categories', 'brands'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'category_id'     => ['required', 'exists:categories,id'],
            'brand_id'        => ['required', 'exists:brands,id'],
            'name_en'         => ['required', 'string', 'max:255'],
            'name_ar'         => ['required', 'string', 'max:255'],
            'description_en'  => ['nullable', 'string'],
            'description_ar'  => ['nullable', 'string'],
            'price'           => ['required', 'numeric', 'min:0'],
            'sale_price'      => ['nullable', 'numeric', 'min:0'],
            'stock'           => ['nullable', 'integer', 'min:0'],
            'track_stock'     => ['required', 'boolean'],
            'sku'             => ['nullable', 'string', 'max:255', 'unique:products,sku'],
            'is_active'       => ['required', 'boolean'],

            'images.*'        => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
            'main_image'      => ['nullable', 'integer', 'min:0'],

            'positions'       => ['nullable', 'array'],
            'positions.*'     => ['in:none,home_top,features_collection,trending,home_products,sidebar_deals,header_menu,best_sellers,new_products,sale_products'],
            'is_featured'     => ['nullable', 'in:0,1'],
            'home_sort'       => ['nullable', 'integer', 'min:0'],
            'size_type' => ['required', 'in:standard,dimensions'],
            'size_type' => ['required','in:standard,dimensions'],

'variants' => ['required','array','min:1'],
'variants.*.size_code' => ['nullable','string','max:50'],
'variants.*.length'    => ['nullable','numeric','min:0'],
'variants.*.width'     => ['nullable','numeric','min:0'],
'variants.*.height'    => ['nullable','numeric','min:0'],
'variants.*.unit'      => ['nullable','string','max:10'],



        ]);

        $data['slug']       = $this->generateUniqueSlug(Product::class, $data['name_en']);
        $data['stock']      = $data['stock'] ?? 0;

        $data['is_featured'] = (int) ($data['is_featured'] ?? 0);
        $data['home_sort']   = (int) ($data['home_sort'] ?? 0);

        $positions = $request->input('positions', []);
        $positions = array_values(array_unique(array_filter($positions)));

        if (in_array('none', $positions)) {
            $positions = ['none'];
        }

        if ($data['is_featured'] !== 1) {
            $data['home_sort'] = 0;
            if (!$positions) {
                $positions = ['none'];
            }
        }

        $data['positions'] = $positions;

        $product = Product::create($data);
$this->saveVariants($product, $request);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $i => $file) {
                ProductImage::create([
                    'product_id' => $product->id,
                    'path'       => $this->uploadFile($file, 'products'),
                    'is_main'    => $i === 0,
                    'sort_order' => $i,
                ]);
            }
        }

        return redirect()->route('admin.products.index')->with('success', __('messages.saved_successfully'));
    }

    public function edit(Product $product)
    {
       
$product->load('images', 'variants');

        $categories = Category::orderBy('sort_order')->get();
        $brands     = Brand::orderBy('sort_order')->get();

        return view('products.edit', compact('product', 'categories', 'brands'));
    }

    public function update(Request $request, Product $product)
    {
        
        $data = $request->validate([
            'category_id'     => ['required', 'exists:categories,id'],
            'brand_id'        => ['required', 'exists:brands,id'],
            'name_en'         => ['required', 'string', 'max:255'],
            'name_ar'         => ['required', 'string', 'max:255'],
            'description_en'  => ['nullable', 'string'],
            'description_ar'  => ['nullable', 'string'],
            'price'           => ['required', 'numeric', 'min:0'],
            'sale_price'      => ['nullable', 'numeric', 'min:0'],
            'stock'           => ['nullable', 'integer', 'min:0'],
            'track_stock'     => ['required', 'boolean'],
            'sku'             => ['nullable', 'string', 'max:255', 'unique:products,sku,' . $product->id],
            'is_active'       => ['required', 'boolean'],

            'images.*'        => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
            'main_image'      => ['nullable', 'integer', 'min:0'],

            'positions'       => ['nullable', 'array'],
            'positions.*'     => ['in:none,home_top,features_collection,trending,home_products,sidebar_deals,header_menu,best_sellers,new_products,sale_products'],
            'is_featured'     => ['nullable', 'in:0,1'],
            'home_sort'       => ['nullable', 'integer', 'min:0'],
            'size_type' => ['required', 'in:standard,dimensions'],

        ]);

        if ($data['name_en'] !== $product->name_en) {
            $data['slug'] = $this->generateUniqueSlug(Product::class, $data['name_en'], $product->id);
        }

        $data['stock'] = $data['stock'] ?? 0;

        $data['is_featured'] = (int) ($data['is_featured'] ?? 0);
        $data['home_sort']   = (int) ($data['home_sort'] ?? 0);

        $positions = $request->input('positions', $product->positions ?? []);
        $positions = array_values(array_unique(array_filter($positions)));

        if (in_array('none', $positions)) {
            $positions = ['none'];
        }

        $data['positions'] = $positions;

       if ($data['is_featured'] !== 1) {
    $data['home_sort'] = 0;
}

        $product->update($data);
$this->saveVariants($product, $request, true);

        if ($request->hasFile('images')) {
            $existingCount = $product->images()->count();
            $mainIndex     = (int) $request->input('main_image', 0);

            $product->images()->update(['is_main' => 0]);

            foreach ($request->file('images') as $i => $file) {
                $filename = time() . '_' . Str::random(8) . '.' . $file->getClientOriginalExtension();
                $folder   = public_path('uploads/products');

                if (!file_exists($folder)) {
                    mkdir($folder, 0755, true);
                }

                $file->move($folder, $filename);

                $relativePath = 'uploads/products/' . $filename;

                $product->images()->create([
                    'path'       => $relativePath,
                    'is_main'    => ($i === $mainIndex),
                    'sort_order' => $existingCount + $i,
                ]);
            }

            if (!$product->images()->where('is_main', 1)->exists()) {
                $first = $product->images()->orderBy('sort_order')->first();
                if ($first) {
                    $first->update(['is_main' => 1]);
                }
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

        $wasMain = (bool) $image->is_main;

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
            'price'      => ['required', 'numeric', 'min:0'],
            'sale_price' => ['nullable', 'numeric', 'min:0'],
        ]);

        $product->update($data);

        return redirect()->route('admin.products.index')->with('success', __('messages.updated_successfully'));
    }

    public function editStock(Product $product)
    {
        return view('products.stock', compact('product'));
    }

    public function updateStock(Request $request, Product $product)
    {
        $data = $request->validate([
            'stock'       => ['required', 'integer', 'min:0'],
            'track_stock' => ['required', 'boolean'],
        ]);

        $product->update($data);

        return redirect()->route('admin.products.index')->with('success', __('messages.updated_successfully'));
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
            'ids'    => ['required', 'array'],
            'ids.*'  => ['integer', 'exists:products,id'],
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

    public function show(Product $product)
    {
        $product->load(['category', 'brand', 'images']);
        return view('products.show', compact('product'));
    }

    public function duplicate(Request $request, Product $product)
    {
        abort_unless(auth()->user()->can('products.create'), 403);

        $product->load('images');

        $new = $product->replicate(['slug', 'sku']);
        $new->name_en   = ($product->name_en ?? '') . ' (Copy)';
        $new->name_ar   = ($product->name_ar ?? '') . ' (نسخة)';
        $new->sku       = null;
        $new->is_active = 0;

        $baseSlug = Str::slug($new->name_en ?: 'product');
        $slug     = $baseSlug;
        $i        = 1;

        while (Product::where('slug', $slug)->exists()) {
            $slug = $baseSlug . '-' . $i++;
        }

        $new->slug = $slug;
        $new->save();

        if ($product->images && $product->images->count()) {
            $destDir = public_path('uploads/products');

            if (!File::exists($destDir)) {
                File::makeDirectory($destDir, 0755, true);
            }

            foreach ($product->images as $img) {
                if (!$img->path) {
                    continue;
                }

                $srcPath = public_path($img->path);

                if (!File::exists($srcPath)) {
                    continue;
                }

                $ext         = pathinfo($srcPath, PATHINFO_EXTENSION) ?: 'jpg';
                $newFilename = time() . '_' . Str::random(10) . '.' . $ext;
                $destPath    = $destDir . DIRECTORY_SEPARATOR . $newFilename;

                File::copy($srcPath, $destPath);

                $newRelativePath = 'uploads/products/' . $newFilename;

                $new->images()->create([
                    'path'       => $newRelativePath,
                    'is_main'    => (int) $img->is_main,
                    'sort_order' => (int) $img->sort_order,
                ]);
            }

            if (!$new->images()->where('is_main', 1)->exists()) {
                $first = $new->images()->orderBy('sort_order')->first();
                if ($first) {
                    $first->update(['is_main' => 1]);
                }
            }
        }

        return redirect()->route('admin.products.edit', $new->id)
            ->with('success', __('messages.product_duplicated'));
    }

private function saveVariants(Product $product, Request $request, bool $isUpdate = false): void
{
    $sizeType = $request->input('size_type', 'standard');
    $variants = $request->input('variants', []);

  
    $variants = array_values(array_filter($variants, function ($v) use ($sizeType) {
        if (!is_array($v)) return false;
        if ($sizeType === 'standard') {
            return !empty($v['size_code']); 
        }
       
        return !empty($v['length']) && !empty($v['width']) && !empty($v['height']);
    }));

    if ($sizeType === 'dimensions' && count($variants) !== 1) {
        throw ValidationException::withMessages([
            'variants' => 'Dimensions size must be exactly one row.',
        ]);
    }

    if ($sizeType === 'standard' && count($variants) < 1) {
        throw ValidationException::withMessages([
            'variants' => 'Please add at least one standard size.',
        ]);
    }


    if ($isUpdate) {
        $product->variants()->delete();
    }

    foreach ($variants as $v) {
        $product->variants()->create([
            'type'      => $sizeType,
            'size_code' => $sizeType === 'standard' ? ($v['size_code'] ?? null) : null,
            'length'    => $sizeType === 'dimensions' ? ($v['length'] ?? null) : null,
            'width'     => $sizeType === 'dimensions' ? ($v['width'] ?? null) : null,
            'height'    => $sizeType === 'dimensions' ? ($v['height'] ?? null) : null,
            'unit'      => $v['unit'] ?? 'cm',

           
        ]);
    }

   
}

}
