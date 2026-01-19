<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
  use App\Models\Currency;
class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
  
     

public function run()
{
    Currency::updateOrCreate(
        ['code' => 'SAR'],
        [
            'name' => 'Saudi Riyal',
            'symbol' => 'ر.س',
            'decimal_places' => 2,
            'is_default' => 1,
            'is_active' => 1,
            'sort_order' => 1,
            'rate' => 1,
        ]
    );

    Currency::updateOrCreate(
        ['code' => 'USD'],
        [
            'name' => 'US Dollar',
            'symbol' => '$',
            'decimal_places' => 2,
            'is_default' => 0,
            'is_active' => 1,
            'sort_order' => 2,
            'rate' => null,
        ]
    );

    Currency::updateOrCreate(
        ['code' => 'AED'],
        [
            'name' => 'UAE Dirham',
            'symbol' => 'د.إ',
            'decimal_places' => 2,
            'is_default' => 0,
            'is_active' => 1,
            'sort_order' => 3,
            'rate' => null,
        ]
    );
}

    
}
