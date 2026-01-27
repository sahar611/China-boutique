<?php

namespace App\Services;

use App\Models\Currency;

class CurrencyService
{
    public static function current()
    {
        return session('currency')
            ?? Currency::where('is_default', 1)->first();
    }

    public static function all()
    {
        return Currency::where('is_active', 1)
            ->orderByDesc('is_default')
            ->get();
    }
}
