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
        Schema::create('lawyers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->unique()->constrained('users')->onDelete('cascade');
            $table->string('name');
            $table->string('email');
            $table->string('phone', 20);
            $table->string('specialization')->nullable();
            $table->string('license_number', 100)->nullable();
            $table->string('bar_association_number', 100)->nullable();
            $table->text('bio')->nullable();
            $table->string('profile_photo_url')->nullable();
            $table->integer('experience_years')->nullable();
            $table->text('education')->nullable();
            $table->text('certifications')->nullable();
            $table->decimal('hourly_rate', 10, 2)->nullable();
            $table->enum('availability_status', ['available', 'busy', 'on_leave'])->default('available');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lawyers');
    }
};
