<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'name',
        'email',
        'phone',
        'phone_alternative',
        'address',
        'city',
        'province',
        'postal_code',
        'country',
        'ktp_number',
        'ktp_file_url',
        'npwp_number',
        'npwp_file_url',
        'company_name',
        'company_type',
        'company_address',
        'company_phone',
        'company_email',
        'company_website',
        'client_type',
        'notes',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Get the user that owns the client.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the cases for the client.
     */
    public function cases(): HasMany
    {
        return $this->hasMany(CaseModel::class);
    }

    /**
     * Get the invoices for the client.
     */
    public function invoices(): HasMany
    {
        return $this->hasMany(Invoice::class);
    }

    /**
     * Get the power of attorneys for the client.
     */
    public function powerOfAttorneys(): HasMany
    {
        return $this->hasMany(PowerOfAttorney::class);
    }
}
