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
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->enum('report_type', ['client_summary', 'case_summary', 'revenue', 'lawyer_performance', 'hearing_schedule', 'custom']);
            $table->string('title');
            $table->text('description')->nullable();
            $table->foreignId('generated_by_id')->constrained('users')->onDelete('restrict');
            $table->json('report_data')->nullable();
            $table->string('export_format')->nullable();
            $table->string('file_url')->nullable();
            $table->json('filters')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};
