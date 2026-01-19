<?php


use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSessionsUsersTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('sessions_users', function (Blueprint $table) {
            $table->increments('id');
            $table->text('gender')->nullable();
            $table->text('latitude')->nullable();
            $table->text('longitude')->nullable(); 
            $table->text('phone')->nullable(); 
            $table->integer('age')->nullable(); 
            $table->integer('region_id')->nullable(); 

            $table->timestamps();
        });
    }                    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sessions_users');
    }
};
