<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Document extends Model
{
    protected $fillable = [
        'document_number',
        'case_id',
        'client_id',
        'uploaded_by_id',
        'folder_id',
        'title',
        'description',
        'file_name',
        'file_url',
        'file_size',
        'file_type',
        'document_type',
        'is_confidential',
        'version',
        'status',
    ];

    protected $casts = [
        'is_confidential' => 'boolean',
    ];

    /**
     * Get the case associated with the document.
     */
    public function case(): BelongsTo
    {
        return $this->belongsTo(CaseModel::class);
    }

    /**
     * Get the client associated with the document.
     */
    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    /**
     * Get the user who uploaded the document.
     */
    public function uploadedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'uploaded_by_id');
    }

    /**
     * Get the versions for the document.
     */
    public function versions(): HasMany
    {
        return $this->hasMany(DocumentVersion::class);
    }
}
