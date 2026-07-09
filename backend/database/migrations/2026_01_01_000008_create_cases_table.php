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
        Schema::create('cases', function (Blueprint $table) {
            $table->id();
            $table->string('case_number', 100)->unique();
            $table->foreignId('client_id')->constrained('clients')->onDelete('cascade');
            $table->foreignId('lawyer_id')->constrained('lawyers')->onDelete('restrict');
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('case_category', 100)->nullable();
            $table->enum('case_type', ['civil', 'criminal', 'corporate', 'family', 'other']);
            $table->enum('status', ['open', 'in_progress', 'on_hold', 'closed', 'archived'])->default('open');
            $table->string('court_name')->nullable();
            $table->string('court_level', 100)->nullable();
            $table->text('court_address')->nullable();
            $table->string('judge_name')->nullable();
            $table->string('opposing_party')->nullable();
            $table->string('opposing_lawyer')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->date('estimated_resolution_date')->nullable();
            $table->decimal('budget', 15, 2)->nullable();
            $table->decimal('spent_amount', 15, 2)->default(0);
            $table->enum('priority', ['low', 'medium', 'high', 'urgent'])->default('medium');
            $table->text('notes')->nullable();
            $table->timestamps();
            $table->index('client_id');
            $table->index('lawyer_id');
            $table->index('status');
            $table->index('case_number');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cases');
    }
};
