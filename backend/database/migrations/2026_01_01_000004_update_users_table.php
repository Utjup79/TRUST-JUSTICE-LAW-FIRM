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
        Schema::table('users', function (Blueprint $table) {
            $table->string('phone')->nullable()->after('email');
            $table->string('profile_photo_path')->nullable()->after('remember_token');
            $table->string('photo_url')->nullable()->after('profile_photo_path');
            $table->timestamp('last_login_at')->nullable()->after('two_factor_recovery_codes');
            $table->boolean('is_active')->default(true)->after('last_login_at');
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['phone', 'profile_photo_path', 'photo_url', 'last_login_at', 'is_active']);
            $table->dropSoftDeletes();
        });
    }
};
