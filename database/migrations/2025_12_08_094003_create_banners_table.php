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
      Schema::create('banners', function (Blueprint $table) {
    $table->id();

    $table->string('title')->nullable();        // EN title
    $table->string('title_ar')->nullable();     // AR title

    $table->text('description')->nullable();    // EN description
    $table->text('description_ar')->nullable(); // AR description

    $table->string('image')->nullable();        // banner image (optional)
    $table->string('url')->nullable();          // link when banner clicked

    $table->tinyInteger('status')->default(1);  // active/inactive

    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('banners');
    }
};
