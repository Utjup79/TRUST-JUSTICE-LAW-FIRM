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
        Schema::create('case_hearing', function (Blueprint $table) {
            $table->id();
            $table->foreignId('case_id')->constrained('cases')->onDelete('cascade');
            $table->foreignId('hearing_id')->constrained('hearings')->onDelete('cascade');
            $table->foreignId('lawyer_id')->constrained('lawyers')->onDelete('restrict');
            $table->timestamps();
            $table->unique(['case_id', 'hearing_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('case_hearing');
    }
};
