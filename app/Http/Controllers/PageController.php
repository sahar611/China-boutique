<?php
namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller; 

class PageController extends Controller
{
   
    public function index()
    {
        $pages = Page::orderBy('id','desc')->paginate(20);
        return view('pages.index', compact('pages'));
    }

    public function create()
    {
        return view('pages.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'slug'       => 'required|unique:pages,slug',
            'title_en'   => 'required|string|max:255',
            'title_ar'   => 'required|string|max:255',
            'content_en' => 'nullable|string',
            'content_ar' => 'nullable|string',
            'status'     => 'required|boolean',
        ]);

        Page::create($data);

        return redirect()->route('pages.index')
            ->with('success', __('messages.created_successfully'));
    }

    public function edit(Page $page)
    {
        return view('pages.edit', compact('page'));
    }

    public function update(Request $request, Page $page)
    {
        $data = $request->validate([
            'slug'       => 'required|unique:pages,slug,'.$page->id,
            'title_en'   => 'required|string|max:255',
            'title_ar'   => 'required|string|max:255',
            'content_en' => 'nullable|string',
            'content_ar' => 'nullable|string',
            'status'     => 'required|boolean',
        ]);

        $page->update($data);

        return redirect()->route('pages.index')
            ->with('success', __('messages.updated_successfully'));
    }

    public function destroy(Page $page)
    {
        $page->delete();

        return redirect()->route('pages.index')
            ->with('success', __('messages.deleted_successfully'));
    }
}
