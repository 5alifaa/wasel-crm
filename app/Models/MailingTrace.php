<?php

namespace App\Models;

use App\MailingTraceStatus;
use Database\Factories\MailingTraceFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MailingTrace extends Model
{
    /** @use HasFactory<MailingTraceFactory> */
    use HasFactory;

    protected $fillable = [
        'mailing_id',
        'lead_id',
        'status',
        'sent_at',
        'error_at',
    ];

    protected $casts = [
        'status' => MailingTraceStatus::class,
        'sent_at' => 'datetime',
        'error_at' => 'datetime',
    ];

    public function mailing(): BelongsTo
    {
        return $this->belongsTo(Mailing::class);
    }

    public function lead(): BelongsTo
    {
        return $this->belongsTo(Lead::class);
    }
}
