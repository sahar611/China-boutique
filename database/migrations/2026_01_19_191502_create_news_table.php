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
       Schema::create('news', function (Blueprint $table) {
    $table->id();

    $table->string('title_ar');
    $table->string('title_en');

    $table->string('slug')->unique();

    $table->longText('content_ar')->nullable();
    $table->longText('content_en')->nullable();

    $table->string('cover')->nullable(); 
    $table->tinyInteger('is_published')->default(0);
    $table->timestamp('published_at')->nullable();

    $table->unsignedInteger('sort_order')->default(0);

    $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();

    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('news');
    }
};
