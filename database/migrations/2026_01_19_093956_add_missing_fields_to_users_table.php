<?php 
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'phone')) {
                $table->string('phone', 20)->nullable()->after('email');
            }

            if (!Schema::hasColumn('users', 'status')) {
                $table->tinyInteger('status')->default(1)->after('password'); // 1 active, 0 inactive
            }

            if (!Schema::hasColumn('users', 'verified')) {
                $table->tinyInteger('verified')->default(0)->after('status'); // 1 verified, 0 no
            }

            if (!Schema::hasColumn('users', 'picture')) {
                $table->string('picture')->nullable()->after('verified');
            }
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'phone')) $table->dropColumn('phone');
            if (Schema::hasColumn('users', 'status')) $table->dropColumn('status');
            if (Schema::hasColumn('users', 'verified')) $table->dropColumn('verified');
            if (Schema::hasColumn('users', 'picture')) $table->dropColumn('picture');
        });
    }
};
