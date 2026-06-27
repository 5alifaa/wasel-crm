<?php

declare(strict_types=1);

namespace App\Models;

use Database\Factories\LeadGroupFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[Fillable([
    'lead_id',
    'group_id',
])]
class LeadGroup extends Model
{
    /** @use HasFactory<LeadGroupFactory> */
    use HasFactory;
}
