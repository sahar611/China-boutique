<?php 
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\NewsletterSubscriber;
use Illuminate\Http\Request;

class NewsletterSubscriberController extends Controller
{
  public function index(Request $request)
  {
    $q = NewsletterSubscriber::query()
      ->when($request->search, fn($qq)=>$qq->where('email','like','%'.$request->search.'%'))
      ->latest();

    $items = $q->paginate(20)->withQueryString();

    return view('newsletter_subscribers.index', compact('items'));
  }

  public function toggle($id)
  {
    $s = NewsletterSubscriber::findOrFail($id);
    $s->update(['is_active' => !$s->is_active]);

    return back()->with('success', __('cms.saved'));
  }
}
