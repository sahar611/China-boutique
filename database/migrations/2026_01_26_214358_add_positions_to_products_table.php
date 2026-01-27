<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
           
            $table->json('positions')->nullable()->after('is_active');

            
            $table->unsignedInteger('home_sort')->default(0)->after('positions');

          
            $table->boolean('is_featured')->default(false)->after('home_sort');
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['positions','home_sort','is_featured']);
        });
    }
};
