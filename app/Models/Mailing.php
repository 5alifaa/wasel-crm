<?php

namespace App\Models;

use App\MailingStatus;
use Database\Factories\MailingFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Mailing extends Model
{
    /** @use HasFactory<MailingFactory> */
    use HasFactory;

    protected $casts = [
        'recipients' => 'array',
    ];

    protected $fillable = [
        'subject',
        'body',
        'status',
        'email_from',
        'recipients',
    ];

    protected $attributes = [
        'status' => MailingStatus::DRAFT,
    ];

    public function traces()
    {
        return $this->hasMany(MailingTrace::class);
    }

    public function leads(): BelongsToMany
    {
        return $this->belongsToMany(Lead::class, 'mailing_traces')
//            ->withPivot('status', 'sent_at')
            ->withTimestamps();
    }
}
