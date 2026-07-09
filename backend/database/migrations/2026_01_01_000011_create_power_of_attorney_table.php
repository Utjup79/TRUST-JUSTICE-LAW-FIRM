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
        Schema::create('power_of_attorney', function (Blueprint $table) {
            $table->id();
            $table->string('poa_number', 100)->unique();
            $table->foreignId('client_id')->constrained('clients')->onDelete('cascade');
            $table->foreignId('lawyer_id')->constrained('lawyers')->onDelete('restrict');
            $table->foreignId('case_id')->nullable()->constrained('cases')->onDelete('set null');
            $table->string('grantor_name');
            $table->string('grantee_name');
            $table->enum('poa_type', ['general', 'specific', 'special', 'irrevocable'])->default('general');
            $table->text('scope_of_authority')->nullable();
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->boolean('is_revoked')->default(false);
            $table->date('revocation_date')->nullable();
            $table->text('revocation_reason')->nullable();
            $table->string('document_url')->nullable();
            $table->string('qr_code_url')->nullable();
            $table->string('digital_signature')->nullable();
            $table->boolean('is_signed')->default(false);
            $table->timestamp('signed_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('power_of_attorney');
    }
};
