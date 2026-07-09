<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Hearing extends Model
{
    protected $fillable = [
        'hearing_number',
        'court_name',
        'hearing_date',
        'hearing_location',
        'judge_name',
        'status',
        'agenda',
        'outcome',
        'notes',
        'reminder_sent_at',
    ];

    protected $casts = [
        'hearing_date' => 'datetime',
        'reminder_sent_at' => 'datetime',
    ];

    /**
     * Get the cases for the hearing.
     */
    public function cases(): BelongsToMany
    {
        return $this->belongsToMany(CaseModel::class, 'case_hearing')->withPivot('lawyer_id')->withTimestamps();
    }

    /**
     * Get the lawyers attending the hearing.
     */
    public function lawyers(): BelongsToMany
    {
        return $this->belongsToMany(Lawyer::class, 'case_hearing');
    }
}
