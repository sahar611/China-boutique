<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CurrencyController extends Controller
{
    private const DEFAULT_CURRENCY_CODE = 'SAR';

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

    /**
     * Create currency
     * - Only SAR can be default
     * - If code = SAR => set default + active
     * - Any other currency => default = 0
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'code'           => 'required|string|size:3|unique:currencies,code',
            'name'           => 'required|string|max:190',
            'symbol'         => 'nullable|string|max:10',
            'decimal_places' => 'required|integer|min:0|max:6',
            'is_active'      => 'nullable|in:0,1',
            'sort_order'     => 'nullable|integer|min:0|max:9999',
        ]);

        $data['code'] = strtoupper($data['code']);
        $data['is_active']  = $data['is_active'] ?? 1;
        $data['sort_order'] = $data['sort_order'] ?? 0;

        // Only SAR can be default
        $data['is_default'] = ($data['code'] === self::DEFAULT_CURRENCY_CODE) ? 1 : 0;

        DB::transaction(function () use ($data) {

            // Create
            Currency::create($data);

            // Enforce: SAR always default + active
            Currency::where('code', self::DEFAULT_CURRENCY_CODE)->update([
                'is_default' => 1,
                'is_active'  => 1,
            ]);

            // Enforce: all other currencies can never be default
            Currency::where('code', '!=', self::DEFAULT_CURRENCY_CODE)->update([
                'is_default' => 0,
            ]);
        });

        return redirect()->route('admin.currencies.index')
            ->with('success', 'Currency created successfully');
    }

    public function edit(Currency $currency)
    {
        return view('currencies.edit', compact('currency'));
    }

    /**
     * Update currency
     * - SAR code can never be changed
     * - SAR always default + active
     * - Non-SAR can never be default
     */
    public function update(Request $request, Currency $currency)
    {
        $data = $request->validate([
            'code'           => 'required|string|size:3|unique:currencies,code,' . $currency->id,
            'name'           => 'required|string|max:190',
            'symbol'         => 'nullable|string|max:10',
            'decimal_places' => 'required|integer|min:0|max:6',
            'is_active'      => 'nullable|in:0,1',
            'sort_order'     => 'nullable|integer|min:0|max:9999',
        ]);

        $data['code'] = strtoupper($data['code']);
        $data['is_active']  = $data['is_active'] ?? 0;
        $data['sort_order'] = $data['sort_order'] ?? 0;

        DB::transaction(function () use ($data, $currency) {

            // Prevent changing SAR code
            if ($currency->code === self::DEFAULT_CURRENCY_CODE) {
                $data['code'] = self::DEFAULT_CURRENCY_CODE;
            }

            // Default rules
            if ($currency->code === self::DEFAULT_CURRENCY_CODE || $data['code'] === self::DEFAULT_CURRENCY_CODE) {
                $data['is_default'] = 1;
                $data['is_active']  = 1;
            } else {
                $data['is_default'] = 0; // Non-SAR can never be default
            }

            // Update the currency row
            $currency->update($data);

            // Enforce again after update
            Currency::where('code', self::DEFAULT_CURRENCY_CODE)->update([
                'is_default' => 1,
                'is_active'  => 1,
            ]);

            Currency::where('code', '!=', self::DEFAULT_CURRENCY_CODE)->update([
                'is_default' => 0,
            ]);
        });

        return redirect()->route('admin.currencies.index')
            ->with('success', 'Currency updated successfully');
    }

    /**
     * Delete currency
     * - SAR can never be deleted
     * - Default currency can never be deleted (extra safety)
     */
    public function destroy(Currency $currency)
    {
        if ($currency->code === self::DEFAULT_CURRENCY_CODE) {
            return back()->withErrors(['error' => 'You cannot delete SAR currency.']);
        }

        if ($currency->is_default) {
            return back()->withErrors(['error' => 'You cannot delete the default currency.']);
        }

        $currency->delete();

        return redirect()->route('admin.currencies.index')
            ->with('success', 'Currency deleted successfully');
    }
}
