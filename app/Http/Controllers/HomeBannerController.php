<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\HomeBanner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
class HomeBannerController extends Controller
{
    public function index()
    {
        $items = HomeBanner::query()
            ->where('position','promo_section')
            ->orderBy('sort_order')
            ->get();

        return view('home_banners.index', compact('items'));
    }

    public function create()
    {
        $item = new HomeBanner(['position'=>'promo_section','is_active'=>1,'sort_order'=>1,'style_class'=>'bg-one']);
        return view('home_banners.form', compact('item'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'discount_percent' => ['nullable','integer','min:0','max:100'],
            'title_en' => ['nullable','string','max:255'],
            'title_ar' => ['nullable','string','max:255'],
            'subtitle_en' => ['nullable','string','max:255'],
            'subtitle_ar' => ['nullable','string','max:255'],
           
            'link' => ['nullable','string','max:255'],
           
            'sort_order' => ['required','integer','min:1'],
            'is_active' => ['required','in:0,1'],
            'image' => ['nullable','image','mimes:jpg,jpeg,png,webp','max:2048'],
        ]);

        $data['position'] = 'promo_section';

     
 if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time().'_'.$file->getClientOriginalName();
            $file->move(public_path('uploads/news'), $filename);
            $data['image'] = 'uploads/news/'.$filename;
        }
        HomeBanner::create($data);

        return redirect()->route('home-banners.index')->with('success','Created');
    }

    public function edit(HomeBanner $home_banner)
    {
        
        $model = $home_banner;
        return view('home_banners.edit', compact('model'));
    }

    public function update(Request $request, HomeBanner $home_banner)
    {
        $data = $request->validate([
            'discount_percent' => ['nullable','integer','min:0','max:100'],
            'title_en' => ['nullable','string','max:255'],
            'title_ar' => ['nullable','string','max:255'],
            'subtitle_en' => ['nullable','string','max:255'],
            'subtitle_ar' => ['nullable','string','max:255'],
           
            'link' => ['nullable','string','max:255'],
            
            'sort_order' => ['required','integer','min:1'],
            'is_active' => ['required','in:0,1'],
            'image' => ['nullable','image','mimes:jpg,jpeg,png,webp','max:2048'],
        ]);

     
  if ($request->hasFile('image')) {

            if ($home_banner->image && File::exists(public_path($home_banner->image))) {
                File::delete(public_path($home_banner->image));
            }

            $file = $request->file('image');
            $filename = time().'_'.$file->getClientOriginalName();
            $file->move(public_path('uploads/news'), $filename);
            $data['image'] = 'uploads/news/'.$filename;
        }

        $home_banner->update($data);

        return redirect()->route('admin.home-banners.index')->with('success','Updated');
    }

    public function destroy(HomeBanner $home_banner)
    {
        if ($home_banner->image && str_starts_with($home_banner->image, 'storage/')) {
            $old = str_replace('storage/','',$home_banner->image);
            Storage::disk('public')->delete($old);
        }
        $home_banner->delete();

        return back()->with('success','Deleted');
    }
}
