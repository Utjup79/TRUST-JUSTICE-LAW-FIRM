<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Report extends Model
{
    protected $fillable = [
        'report_type',
        'title',
        'description',
        'generated_by_id',
        'report_data',
        'export_format',
        'file_url',
        'filters',
    ];

    protected $casts = [
        'report_data' => 'json',
        'filters' => 'json',
    ];

    /**
     * Get the user who generated the report.
     */
    public function generatedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'generated_by_id');
    }
}
