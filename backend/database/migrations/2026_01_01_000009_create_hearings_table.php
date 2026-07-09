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
        Schema::create('hearings', function (Blueprint $table) {
            $table->id();
            $table->string('hearing_number', 100)->unique();
            $table->string('court_name');
            $table->dateTime('hearing_date');
            $table->text('hearing_location')->nullable();
            $table->string('judge_name')->nullable();
            $table->enum('status', ['scheduled', 'rescheduled', 'completed', 'cancelled', 'postponed'])->default('scheduled');
            $table->text('agenda')->nullable();
            $table->text('outcome')->nullable();
            $table->text('notes')->nullable();
            $table->timestamp('reminder_sent_at')->nullable();
            $table->timestamps();
            $table->index('hearing_date');
            $table->index('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hearings');
    }
};
