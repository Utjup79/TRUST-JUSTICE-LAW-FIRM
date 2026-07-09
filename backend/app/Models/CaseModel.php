<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class CaseModel extends Model
{
    protected $table = 'cases';

    protected $fillable = [
        'case_number',
        'client_id',
        'lawyer_id',
        'title',
        'description',
        'case_category',
        'case_type',
        'status',
        'court_name',
        'court_level',
        'court_address',
        'judge_name',
        'opposing_party',
        'opposing_lawyer',
        'start_date',
        'end_date',
        'estimated_resolution_date',
        'budget',
        'spent_amount',
        'priority',
        'notes',
    ];

    protected $casts = [
        'budget' => 'decimal:2',
        'spent_amount' => 'decimal:2',
        'start_date' => 'date',
        'end_date' => 'date',
        'estimated_resolution_date' => 'date',
    ];

    /**
     * Get the client that owns the case.
     */
    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    /**
     * Get the lawyer handling the case.
     */
    public function lawyer(): BelongsTo
    {
        return $this->belongsTo(Lawyer::class);
    }

    /**
     * Get the hearings for the case.
     */
    public function hearings(): BelongsToMany
    {
        return $this->belongsToMany(Hearing::class, 'case_hearing')->withPivot('lawyer_id')->withTimestamps();
    }

    /**
     * Get the documents for the case.
     */
    public function documents(): HasMany
    {
        return $this->hasMany(Document::class);
    }

    /**
     * Get the invoices for the case.
     */
    public function invoices(): HasMany
    {
        return $this->hasMany(Invoice::class);
    }

    /**
     * Get the power of attorneys for the case.
     */
    public function powerOfAttorneys(): HasMany
    {
        return $this->hasMany(PowerOfAttorney::class);
    }
}
