<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PowerOfAttorney extends Model
{
    protected $table = 'power_of_attorney';

    protected $fillable = [
        'poa_number',
        'client_id',
        'lawyer_id',
        'case_id',
        'grantor_name',
        'grantee_name',
        'poa_type',
        'scope_of_authority',
        'start_date',
        'end_date',
        'is_revoked',
        'revocation_date',
        'revocation_reason',
        'document_url',
        'qr_code_url',
        'digital_signature',
        'is_signed',
        'signed_date',
    ];

    protected $casts = [
        'is_revoked' => 'boolean',
        'is_signed' => 'boolean',
        'start_date' => 'date',
        'end_date' => 'date',
        'revocation_date' => 'date',
        'signed_date' => 'datetime',
    ];

    /**
     * Get the client associated with the POA.
     */
    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    /**
     * Get the lawyer associated with the POA.
     */
    public function lawyer(): BelongsTo
    {
        return $this->belongsTo(Lawyer::class);
    }

    /**
     * Get the case associated with the POA.
     */
    public function case(): BelongsTo
    {
        return $this->belongsTo(CaseModel::class);
    }
}
