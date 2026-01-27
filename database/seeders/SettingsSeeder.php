<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SettingsSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();

        $settings = [
            [
                'key' => 'phone',
                'value' => '+201234567890',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'key' => 'whatsapp',
                'value' => '+201234567890',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'key' => 'email',
                'value' => 'info@chinaboutique.com',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'key' => 'tiktok',
                'value' => 'https://www.tiktok.com/@chinaboutique',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'key' => 'snapchat',
                'value' => 'https://www.snapchat.com/add/chinaboutique',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'key' => 'instagram',
                'value' => 'https://www.instagram.com/chinaboutique',
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ];

        DB::table('settings')->upsert(
            $settings,
            ['key'],      // unique column
            ['value', 'updated_at']
        );
    }
}
