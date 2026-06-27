<?php

namespace App\Models;

use App\MailingStatus;
use Database\Factories\MailingFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
