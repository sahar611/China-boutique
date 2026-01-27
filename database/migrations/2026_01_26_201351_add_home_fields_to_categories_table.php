<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->boolean('is_featured')->default(false)->after('is_active');
            $table->string('home_position', 50)->nullable()->after('is_featured');
            $table->unsignedInteger('home_sort')->default(0)->after('home_position');

            $table->index(['is_featured', 'home_position', 'home_sort']);
        });
    }

    public function down(): void
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->dropIndex(['is_featured', 'home_position', 'home_sort']);
            $table->dropColumn(['is_featured', 'home_position', 'home_sort']);
        });
    }
};
