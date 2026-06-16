<?php

namespace App\Models;

use App\LeadSource;
use App\LeadStatus;
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

    /** @use HasFactory<\Database\Factories\LeadFactory> */
    use HasFactory;
}
