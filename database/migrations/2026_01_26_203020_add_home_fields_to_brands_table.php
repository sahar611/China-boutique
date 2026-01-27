<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('brands', function (Blueprint $table) {
            $table->boolean('is_featured')
                  ->default(false)
                  ->after('is_active');

            $table->unsignedInteger('home_sort')
                  ->default(0)
                  ->after('is_featured');

            $table->index(['is_active', 'is_featured', 'home_sort']);
        });
    }

    public function down(): void
    {
        Schema::table('brands', function (Blueprint $table) {
            $table->dropIndex(['is_active', 'is_featured', 'home_sort']);
            $table->dropColumn(['is_featured', 'home_sort']);
        });
    }
};
