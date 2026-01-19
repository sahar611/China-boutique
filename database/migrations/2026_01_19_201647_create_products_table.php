<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();

            $table->foreignId('category_id')->constrained()->cascadeOnDelete();
            $table->foreignId('brand_id')->constrained()->restrictOnDelete();

            $table->string('name_en');
            $table->string('name_ar');
            $table->string('slug')->unique();

            $table->text('description_en')->nullable();
            $table->text('description_ar')->nullable();

            $table->decimal('price', 10, 2);
            $table->decimal('sale_price', 10, 2)->nullable();

            $table->unsignedInteger('stock')->default(0);
            $table->boolean('track_stock')->default(true);

            $table->string('sku')->nullable()->unique();
            $table->boolean('is_active')->default(true);

            $table->timestamps();

            $table->index(['category_id', 'brand_id', 'is_active']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
