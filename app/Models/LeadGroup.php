<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeadGroup extends Model
{
    /** @use HasFactory<\Database\Factories\LeadGroupFactory> */
    use HasFactory;

    protected $fillable = [
        'lead_id',
        'group_id'
    ];
}
