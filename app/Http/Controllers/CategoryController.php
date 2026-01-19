<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Support\GeneratesUniqueSlug;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Support\UploadsToPublic;

class CategoryController extends Controller
{
    use GeneratesUniqueSlug; use UploadsToPublic;
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
        ]);

        $data['slug'] = $this->generateUniqueSlug(Category::class, $data['name_en']);

        if ($request->hasFile('image')) {
            $data['image'] = $this->uploadFile($request->file('image'), 'categories');
        }

        $data['sort_order'] = $data['sort_order'] ?? 0;

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
        ]);

       
        if ($data['name_en'] !== $category->name_en) {
            $data['slug'] = $this->generateUniqueSlug(Category::class, $data['name_en'], $category->id);
        }

        if ($request->hasFile('image')) {
            $this->deleteFile($category->image);
            $data['image'] = $this->uploadFile($request->file('image'), 'categories');
        }

        $data['sort_order'] = $data['sort_order'] ?? 0;

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
