<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Support\GeneratesUniqueSlug;
use App\Support\UploadsToPublic;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    use GeneratesUniqueSlug, UploadsToPublic;

    public function __construct()
    {
        $this->middleware('permission:categories.view')->only(['index','show']);
        $this->middleware('permission:categories.create')->only(['create','store']);
        $this->middleware('permission:categories.edit')->only(['edit','update']);
        $this->middleware('permission:categories.delete')->only(['destroy']);

        $this->middleware('permission:categories.sort')->only(['sort','updateSort']);
    }

    public function index()
    {
        $categories = Category::with('parent')
            ->orderBy('sort_order')
            ->latest()
            ->paginate(20);

        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        $parents = Category::whereNull('parent_id')->orderBy('sort_order')->get();
        return view('categories.create', compact('parents'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
    'parent_id'   => ['nullable','exists:categories,id'],
    'name_en'     => ['required','string','max:255'],
    'name_ar'     => ['required','string','max:255'],
    'image'       => ['nullable','image','mimes:jpg,jpeg,png,webp','max:4096'],
    'is_active'   => ['required','boolean'],
    'sort_order'  => ['nullable','integer','min:0'],

    'is_featured' => ['nullable','in:0,1'],
    'home_sort'   => ['nullable','integer','min:0','required_if:is_featured,1'],

    'positions'   => ['nullable','array','required_if:is_featured,1'],
    'positions.*' => ['in:none,home_sidebar,header_dropdown,home_top_categories,home_tabs'],
]);

        $data['slug'] = $this->generateUniqueSlug(Category::class, $data['name_en']);

        if ($request->hasFile('image')) {
            $data['image'] = $this->uploadFile($request->file('image'), 'categories');
        }

        $data['sort_order']  = (int)($data['sort_order'] ?? 0);
        $data['is_featured'] = (int)($data['is_featured'] ?? 0);
        $data['home_sort']   = (int)($data['home_sort'] ?? 0);

        // positions sanitize
        $positions = $request->input('positions', []);
        $positions = array_values(array_unique(array_filter($positions)));

        if (in_array('none', $positions)) {
            $positions = ['none'];
        }

       
        if ($data['is_featured'] !== 1) {
            $data['home_sort'] = 0;
            $positions = ['none'];
        }

        $data['positions'] = $positions;

        Category::create($data);

        return redirect()->route('admin.categories.index')
            ->with('success', __('messages.saved_successfully'));
    }

    public function edit(Category $category)
    {
        $parents = Category::whereNull('parent_id')
            ->where('id', '!=', $category->id)
            ->orderBy('sort_order')
            ->get();

        return view('categories.edit', compact('category','parents'));
    }

    public function update(Request $request, Category $category)
    {
        $data = $request->validate([
    'parent_id'   => ['nullable','exists:categories,id'],
    'name_en'     => ['required','string','max:255'],
    'name_ar'     => ['required','string','max:255'],
    'image'       => ['nullable','image','mimes:jpg,jpeg,png,webp','max:4096'],
    'is_active'   => ['required','boolean'],
    'sort_order'  => ['nullable','integer','min:0'],

    'is_featured' => ['nullable','in:0,1'],
    'home_sort'   => ['nullable','integer','min:0','required_if:is_featured,1'],

    'positions'   => ['nullable','array','required_if:is_featured,1'],
    'positions.*' => ['in:none,home_sidebar,header_dropdown,home_top_categories,home_tabs'],
]);


        if ($data['name_en'] !== $category->name_en) {
            $data['slug'] = $this->generateUniqueSlug(Category::class, $data['name_en'], $category->id);
        }

        if ($request->hasFile('image')) {
            $this->deleteFile($category->image);
            $data['image'] = $this->uploadFile($request->file('image'), 'categories');
        }

        $data['sort_order']  = (int)($data['sort_order'] ?? 0);
        $data['is_featured'] = (int)($data['is_featured'] ?? 0);
        $data['home_sort']   = (int)($data['home_sort'] ?? 0);

        // positions sanitize
        $positions = $request->input('positions', $category->positions ?? []);
        $positions = array_values(array_unique(array_filter($positions)));

        if (in_array('none', $positions)) {
            $positions = ['none'];
        }

        if ($data['is_featured'] !== 1) {
            $data['home_sort'] = 0;
            $positions = ['none'];
        }

        $data['positions'] = $positions;

        $category->update($data);

        return redirect()->route('admin.categories.index')
            ->with('success', __('messages.updated_successfully'));
    }

    public function destroy(Category $category)
    {
        $this->deleteFile($category->image);
        $category->delete();

        return redirect()->route('admin.categories.index')
            ->with('success', __('messages.deleted_successfully'));
    }
}
