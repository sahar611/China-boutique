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
       Schema::create('orders', function (Blueprint $table) {
      $table->id();
      $table->string('code')->unique();
      $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();

      $table->string('customer_name');
      $table->string('customer_email');
      $table->string('customer_phone')->nullable();
      $table->string('shipping_address')->nullable();

      $table->string('currency_code')->default('SAR');
      $table->decimal('currency_rate', 12, 6)->default(1);

      $table->decimal('subtotal', 10, 2)->default(0);
      $table->decimal('shipping', 10, 2)->default(0);
      $table->decimal('discount', 10, 2)->default(0);
      $table->decimal('total', 10, 2)->default(0);

      $table->string('payment_method')->default('bank'); // bank | online
      $table->string('payment_status')->default('pending'); // pending | paid | failed
      $table->string('status')->default('new'); // new | processing | shipped | completed | canceled

      $table->string('bank_receipt')->nullable(); // path
      $table->timestamp('placed_at')->nullable();

      $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
