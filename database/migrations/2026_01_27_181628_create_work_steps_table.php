<?php 
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  public function up(): void
  {
    Schema::create('work_steps', function (Blueprint $table) {
      $table->id();
      $table->unsignedTinyInteger('step_no')->default(1); // 1..4
      $table->string('title_en');
      $table->string('title_ar');
      $table->text('desc_en')->nullable();
      $table->text('desc_ar')->nullable();

      // icon type: either "class" (like flaticon/FontAwesome) or "image" path
      $table->enum('icon_type', ['class','image'])->default('class');
      $table->string('icon_class')->nullable(); // e.g. "flaticon-search"
      $table->string('icon_image')->nullable(); // stored path

      $table->unsignedSmallInteger('sort_order')->default(1);
      $table->boolean('is_active')->default(true);
      $table->timestamps();
    });
  }

  public function down(): void
  {
    Schema::dropIfExists('work_steps');
  }
};
