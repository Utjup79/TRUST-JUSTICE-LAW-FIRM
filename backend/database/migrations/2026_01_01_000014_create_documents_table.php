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
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->string('document_number', 100)->unique();
            $table->foreignId('case_id')->nullable()->constrained('cases')->onDelete('cascade');
            $table->foreignId('client_id')->nullable()->constrained('clients')->onDelete('cascade');
            $table->foreignId('uploaded_by_id')->constrained('users')->onDelete('restrict');
            $table->foreignId('folder_id')->nullable();
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('file_name');
            $table->string('file_url');
            $table->bigInteger('file_size')->nullable();
            $table->string('file_type', 50)->nullable();
            $table->string('document_type', 100)->nullable();
            $table->boolean('is_confidential')->default(false);
            $table->integer('version')->default(1);
            $table->enum('status', ['draft', 'active', 'archived', 'deleted'])->default('active');
            $table->timestamps();
            $table->index('case_id');
            $table->index('client_id');
            $table->index('uploaded_by_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documents');
    }
};
