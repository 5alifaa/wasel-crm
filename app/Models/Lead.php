<?php

namespace App\Models;

use App\LeadSource;
use App\LeadStatus;
use Database\Factories\LeadFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    protected $casts = [
        'source' => LeadSource::class,
        'status' => LeadStatus::class,
    ];

    protected $attributes = [
        'status' => LeadStatus::NEW,
    ];

    /** @use HasFactory<LeadFactory> */
    use HasFactory;

    public function mailings()
    {
        return $this->hasMany(MailingTrace::class);
    }
}
