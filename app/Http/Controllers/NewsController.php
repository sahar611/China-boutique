<?php
namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class NewsController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:news.view')->only(['index']);
        $this->middleware('permission:news.create')->only(['create','store']);
        $this->middleware('permission:news.edit')->only(['edit','update']);
        $this->middleware('permission:news.delete')->only(['destroy']);
        $this->middleware('permission:news.publish')->only(['update']);
    }

    public function index()
    {
        $items = News::orderBy('sort_order')->orderByDesc('id')->paginate(15);
        return view('news.index', compact('items'));
    }

    public function create()
    {
        return view('news.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title_ar' => 'required|string|max:255',
            'title_en' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:news,slug',
            'content_ar' => 'nullable|string',
            'content_en' => 'nullable|string',
            'cover' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'is_published' => 'nullable|in:0,1',
            'published_at' => 'nullable|date',
            'sort_order' => 'nullable|integer|min:0|max:9999',
        ]);

        $data['is_published'] = $data['is_published'] ?? 0;
        $data['sort_order'] = $data['sort_order'] ?? 0;
        $data['created_by'] = auth()->id();

        if ($request->hasFile('cover')) {
            $file = $request->file('cover');
            $filename = time().'_'.$file->getClientOriginalName();
            $file->move(public_path('uploads/news'), $filename);
            $data['cover'] = 'uploads/news/'.$filename;
        }

       
        if (!empty($data['is_published']) && empty($data['published_at'])) {
            $data['published_at'] = now();
        }

        News::create($data);

        return redirect()->route('admin.news.index')->with('success', __('cms.created_success'));
    }

    public function edit(News $news)
    {
        $model = $news;
        return view('news.edit', compact('model'));
    }

    public function update(Request $request, News $news)
    {
        $data = $request->validate([
            'title_ar' => 'required|string|max:255',
            'title_en' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:news,slug,' . $news->id,
            'content_ar' => 'nullable|string',
            'content_en' => 'nullable|string',
            'cover' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'is_published' => 'nullable|in:0,1',
            'published_at' => 'nullable|date',
            'sort_order' => 'nullable|integer|min:0|max:9999',
        ]);

        $data['is_published'] = $data['is_published'] ?? 0;
        $data['sort_order'] = $data['sort_order'] ?? 0;

        if ($request->hasFile('cover')) {

            if ($news->cover && File::exists(public_path($news->cover))) {
                File::delete(public_path($news->cover));
            }

            $file = $request->file('cover');
            $filename = time().'_'.$file->getClientOriginalName();
            $file->move(public_path('uploads/news'), $filename);
            $data['cover'] = 'uploads/news/'.$filename;
        }

        if (!empty($data['is_published']) && empty($data['published_at'])) {
            $data['published_at'] = now();
        }

        $news->update($data);

        return redirect()->route('admin.news.index')->with('success', __('cms.updated_success'));
    }

    public function destroy(News $news)
    {
        if ($news->cover && File::exists(public_path($news->cover))) {
            File::delete(public_path($news->cover));
        }

        $news->delete();

        return redirect()->route('admin.news.index')->with('success', __('cms.deleted_success'));
    }
}
