<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Lawyer extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'email',
        'phone',
        'specialization',
        'license_number',
        'bar_association_number',
        'bio',
        'profile_photo_url',
        'experience_years',
        'education',
        'certifications',
        'hourly_rate',
        'availability_status',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'hourly_rate' => 'decimal:2',
    ];

    /**
     * Get the user associated with the lawyer.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the cases handled by the lawyer.
     */
    public function cases(): HasMany
    {
        return $this->hasMany(CaseModel::class);
    }

    /**
     * Get the invoices created by the lawyer.
     */
    public function invoices(): HasMany
    {
        return $this->hasMany(Invoice::class);
    }

    /**
     * Get the power of attorneys created by the lawyer.
     */
    public function powerOfAttorneys(): HasMany
    {
        return $this->hasMany(PowerOfAttorney::class);
    }

    /**
     * Get the hearings attended by the lawyer.
     */
    public function hearings(): BelongsToMany
    {
        return $this->belongsToMany(Hearing::class, 'case_hearing');
    }
}
