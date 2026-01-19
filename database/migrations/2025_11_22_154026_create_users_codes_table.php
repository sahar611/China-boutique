<?php


use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersCodesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users_codes', function (Blueprint $table) {
            $table->increments('id'); 
            $table->text('otp');
            $table->text('phone')->nullable();
            $table->integer('user_id')->nullable(); 
            $table->integer('status')->nullable(); 
            $table->timestamps();
        });
    }        

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users_codes');
    }
};
