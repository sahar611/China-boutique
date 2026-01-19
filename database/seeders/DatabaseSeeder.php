<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

       DB::table('users')->insert([
            'name' => 'admin admin',
            'email' => 'admin@admin.com',
            'account_type' => 'staff',
            'password' => Hash::make('123456'),
             'created_at' => now(),
            'updated_at' => now(),
        ]);
       
    }
}
