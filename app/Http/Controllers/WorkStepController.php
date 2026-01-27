<?php 
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\WorkStep;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class WorkStepController extends Controller
{
  public function index()
  {
    $items = WorkStep::query()
      ->orderBy('sort_order')
      ->get();

    return view('work_steps.index', compact('items'));
  }

  public function edit()
  {
    $items = WorkStep::query()
      ->orderBy('sort_order')
      ->get();

    return view('work_steps.edit', compact('items'));
  }

 public function update(Request $request)
{
  $request->validate([
    'items' => ['required','array'],
    'items.*.id' => ['required','exists:work_steps,id'],
    'items.*.step_no' => ['required','integer','min:1','max:4'],
    'items.*.title_en' => ['required','string','max:255'],
    'items.*.title_ar' => ['required','string','max:255'],
    'items.*.desc_en' => ['nullable','string'],
    'items.*.desc_ar' => ['nullable','string'],
    'items.*.sort_order' => ['required','integer','min:1','max:99'],
    'items.*.is_active' => ['nullable','in:0,1'],

    'items.*.icon_type' => ['required','in:class,image'],
    'items.*.icon_class' => ['nullable','string','max:255'],
    'items.*.icon_image' => ['nullable','image','mimes:jpg,jpeg,png,webp','max:2048'],
  ]);

  foreach ($request->items as $i => $row) {
    $step = WorkStep::findOrFail($row['id']);

    $data = [
      'step_no' => (int)$row['step_no'],
      'title_en' => $row['title_en'],
      'title_ar' => $row['title_ar'],
      'desc_en' => $row['desc_en'] ?? null,
      'desc_ar' => $row['desc_ar'] ?? null,
      'sort_order' => (int)$row['sort_order'],
      'is_active' => isset($row['is_active']) ? (int)$row['is_active'] : 0,
      'icon_type' => $row['icon_type'],
      'icon_class' => $row['icon_type'] === 'class' ? ($row['icon_class'] ?? null) : null,
    ];

    if ($row['icon_type'] === 'image' && $request->hasFile("items.$i.icon_image")) {
      $file = $request->file("items.$i.icon_image");
      $path = $file->store('uploads/work_steps', 'public');

      // احذفي القديم لو موجود
      if ($step->icon_image) {
        Storage::disk('public')->delete(str_replace('storage/', '', $step->icon_image));
      }

      $data['icon_image'] = 'storage/' . $path;
    }

    $step->update($data);
  }

  return redirect()->route('admin.work_steps.edit')->with('success', __('cms.saved'));
}

}
