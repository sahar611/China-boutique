<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('home_banners', function (Blueprint $table) {
    $table->id();

    $table->string('position')->default('promo'); // promo_section
    $table->unsignedInteger('sort_order')->default(0);
    $table->boolean('is_active')->default(true);

    
    $table->unsignedInteger('discount_percent')->nullable(); 

   
    $table->string('title_en')->nullable();
    $table->string('title_ar')->nullable();
    $table->string('subtitle_en')->nullable();
    $table->string('subtitle_ar')->nullable();

   
    $table->string('link')->nullable();

  
    $table->string('image')->nullable(); 

    

    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('home_banners');
    }
};
