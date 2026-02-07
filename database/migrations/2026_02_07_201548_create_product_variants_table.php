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
       Schema::create('product_variants', function (Blueprint $table) {
    $table->id();
    $table->foreignId('product_id')->constrained()->cascadeOnDelete();

    $table->enum('type', ['standard', 'dimensions'])->default('standard');

    // standard sizes مثل S, M, L
    $table->string('size_code', 50)->nullable();

    // dimensions مثل 30×20×10
    $table->decimal('length', 10, 2)->nullable();
    $table->decimal('width', 10, 2)->nullable();
    $table->decimal('height', 10, 2)->nullable();
    $table->string('unit', 10)->default('cm');

   

    $table->timestamps();

    $table->index(['product_id', 'type']);
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_variants');
    }
};
