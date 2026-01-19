<?php
namespace App\Http\Controllers;

use App\Models\Currency;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CurrencyController extends Controller
{
    public function __construct()
{
    $this->middleware('permission:currencies.view')->only(['index']);
    $this->middleware('permission:currencies.create')->only(['create','store']);
    $this->middleware('permission:currencies.edit')->only(['edit','update']);
    $this->middleware('permission:currencies.delete')->only(['destroy']);
}
    public function index()
    {
        $currencies = Currency::orderBy('sort_order')
            ->orderBy('name')
            ->get();

        return view('currencies.index', compact('currencies'));
    }

    public function create()
    {
        return view('currencies.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'code' => 'required|string|size:3|unique:currencies,code',
            'name' => 'required|string|max:190',
            'symbol' => 'nullable|string|max:10',
            'decimal_places' => 'required|integer|min:0|max:6',
            'is_active' => 'nullable|in:0,1',
            'is_default' => 'nullable|in:0,1',
            'sort_order' => 'nullable|integer|min:0|max:9999',
        ]);

        $data['code'] = strtoupper($data['code']);
        $data['is_active'] = $data['is_active'] ?? 1;
        $data['is_default'] = $data['is_default'] ?? 0;
        $data['sort_order'] = $data['sort_order'] ?? 0;

        DB::transaction(function () use ($data) {
           
            if (!empty($data['is_default'])) {
                Currency::where('is_default', 1)->update(['is_default' => 0]);
            }
            Currency::create($data);

           
            if (Currency::count() === 1) {
                Currency::query()->latest('id')->first()?->update(['is_default' => 1]);
            }
        });

        return redirect()->route('admin.currencies.index')->with('success', 'Currency created successfully');
    }

    public function edit(Currency $currency)
    {
        return view('currencies.edit', compact('currency'));
    }

    public function update(Request $request, Currency $currency)
    {
        $data = $request->validate([
            'code' => 'required|string|size:3|unique:currencies,code,' . $currency->id,
            'name' => 'required|string|max:190',
            'symbol' => 'nullable|string|max:10',
            'decimal_places' => 'required|integer|min:0|max:6',
            'is_active' => 'nullable|in:0,1',
            'is_default' => 'nullable|in:0,1',
            'sort_order' => 'nullable|integer|min:0|max:9999',
        ]);

        $data['code'] = strtoupper($data['code']);
        $data['is_active'] = $data['is_active'] ?? 0;
        $data['is_default'] = $data['is_default'] ?? 0;
        $data['sort_order'] = $data['sort_order'] ?? 0;

        DB::transaction(function () use ($data, $currency) {
            if (!empty($data['is_default'])) {
                Currency::where('is_default', 1)->where('id', '!=', $currency->id)->update(['is_default' => 0]);
            }

          
            if ($currency->is_default && empty($data['is_default'])) {
                $data['is_default'] = 1;
            }

            $currency->update($data);
        });

        return redirect()->route('admin.currencies.index')->with('success', 'Currency updated successfully');
    }

    public function destroy(Currency $currency)
    {
       
        if ($currency->is_default) {
            return back()->withErrors(['error' => 'You cannot delete the default currency.']);
        }

        $currency->delete();

        return redirect()->route('admin.currencies.index')->with('success', 'Currency deleted successfully');
    }
}
