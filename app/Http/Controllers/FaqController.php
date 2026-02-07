<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function index(Request $request)
    {
        $q = Faq::query();

        if ($search = $request->get('q')) {
            $q->where('question_en', 'like', "%$search%")
              ->orWhere('question_ar', 'like', "%$search%");
        }

        $faqs = $q->orderBy('sort_order')
                  ->orderByDesc('id')
                  ->paginate(20)
                  ->withQueryString();

        return view('faqs.index', compact('faqs'));
    }

    public function create()
    {
        $faq = new Faq();
        return view('faqs.form', compact('faq'));
    }

    public function store(Request $request)
    {
        $data = $this->validateData($request);
        Faq::create($data);

        return redirect()->route('admin.faqs.index')->with('success', 'Created successfully.');
    }

    public function edit(Faq $faq)
    {
        return view('faqs.form', compact('faq'));
    }

    public function update(Request $request, Faq $faq)
    {
        $data = $this->validateData($request, $faq->id);
        $faq->update($data);

        return redirect()->route('admin.faqs.index')->with('success', 'Updated successfully.');
    }

  
    public function destroy(Faq $faq)
    {
        $faq->delete();
        return back()->with('success', 'Deleted successfully.');
    }

    private function validateData(Request $request, $id = null)
    {
        return $request->validate([
            'question_en' => ['nullable','string','max:255'],
            'question_ar' => ['nullable','string','max:255'],
            'answer_en'   => ['nullable','string'],
            'answer_ar'   => ['nullable','string'],
            'sort_order'  => ['nullable','integer','min:0'],
            'is_active'   => ['required','boolean'],
        ]);
    }
}
