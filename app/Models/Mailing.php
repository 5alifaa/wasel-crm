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
        'domain' => 'json',
    ];

    protected $fillable = [
        'subject',
        'body',
        'status',
        'email_from',
        'domain',
    ];

    protected $attributes = [
        'status' => MailingStatus::DRAFT,
    ];
}
