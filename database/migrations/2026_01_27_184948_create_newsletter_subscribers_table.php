<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  public function up(): void
  {
    Schema::create('newsletter_subscribers', function (Blueprint $table) {
      $table->id();
      $table->string('email')->unique();
      $table->string('name')->nullable();
      $table->string('locale', 5)->nullable(); // ar/en
      $table->string('ip')->nullable();
      $table->timestamp('subscribed_at')->nullable();
      $table->boolean('is_active')->default(true);
      $table->timestamps();
    });
  }

  public function down(): void
  {
    Schema::dropIfExists('newsletter_subscribers');
  }
};
