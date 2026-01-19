<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Support\GeneratesUniqueSlug;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Support\UploadsToPublic;

class BrandController extends Controller
{
    use GeneratesUniqueSlug;   
     use UploadsToPublic;

public function __construct()
{
    $this->middleware('permission:brands.view')->only(['index','show']);
    $this->middleware('permission:brands.create')->only(['create','store']);
    $this->middleware('permission:brands.edit')->only(['edit','update']);
    $this->middleware('permission:brands.delete')->only(['destroy']);
}

    public function index()
    {
        $brands = Brand::orderBy('sort_order')->latest()->paginate(20);
        return view('brands.index', compact('brands'));
    }

    public function create()
    {
        return view('brands.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name_en'         => ['required','string','max:255'],
            'name_ar'         => ['required','string','max:255'],
            'description_en'  => ['nullable','string'],
            'description_ar'  => ['nullable','string'],
            'logo'            => ['nullable','image','mimes:jpg,jpeg,png,webp','max:4096'],
            'is_active'       => ['required','boolean'],
            'sort_order'      => ['nullable','integer','min:0'],
        ]);

        $data['slug'] = $this->generateUniqueSlug(Brand::class, $data['name_en']);

      if ($request->hasFile('logo')) {
            $data['logo'] = $this->uploadFile($request->file('logo'), 'brands');
        }

        $data['sort_order'] = $data['sort_order'] ?? 0;

        Brand::create($data);

        return redirect()->route('admin.brands.index')->with('success', __('messages.saved_successfully'));
    }

    public function edit(Brand $brand)
    {
        return view('brands.edit', compact('brand'));
    }

    public function update(Request $request, Brand $brand)
    {
        $data = $request->validate([
            'name_en'         => ['required','string','max:255'],
            'name_ar'         => ['required','string','max:255'],
            'description_en'  => ['nullable','string'],
            'description_ar'  => ['nullable','string'],
            'logo'            => ['nullable','image','mimes:jpg,jpeg,png,webp','max:4096'],
            'is_active'       => ['required','boolean'],
            'sort_order'      => ['nullable','integer','min:0'],
        ]);

        if ($data['name_en'] !== $brand->name_en) {
            $data['slug'] = $this->generateUniqueSlug(Brand::class, $data['name_en'], $brand->id);
        }

       if ($request->hasFile('logo')) {
            $this->deleteFile($brand->logo);
            $data['logo'] = $this->uploadFile($request->file('logo'), 'brands');
        }

        $data['sort_order'] = $data['sort_order'] ?? 0;

        $brand->update($data);

        return redirect()->route('admin.brands.index')->with('success', __('messages.updated_successfully'));
    }

    public function destroy(Brand $brand)
    {
         $this->deleteFile($brand->logo);
        $brand->delete();

        return redirect()->route('admin.brands.index')->with('success', __('messages.deleted_successfully'));
    }
}
