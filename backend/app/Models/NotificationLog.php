<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class NotificationLog extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'notification_type',
        'title',
        'message',
        'data',
        'is_read',
        'read_at',
        'sent_via',
        'created_at',
    ];

    protected $casts = [
        'data' => 'json',
        'is_read' => 'boolean',
        'created_at' => 'datetime',
        'read_at' => 'datetime',
    ];

    /**
     * Get the user associated with the notification.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
