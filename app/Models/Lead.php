<?php

namespace App\Models;

use App\LeadSource;
use App\LeadStatus;
use Database\Factories\LeadFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Lead extends Model
{
    protected $casts = [
        'source' => LeadSource::class,
        'status' => LeadStatus::class,
    ];

    protected $attributes = [
        'status' => LeadStatus::NEW,
    ];

    protected $fillable = [
        'name',
        'email',
        'country',
        'birth_date',
        'phone',
        'source',
        'status',
    ];

    /** @use HasFactory<LeadFactory> */
    use HasFactory;

    public function mailings()
    {
        return $this->belongsToMany(Mailing::class, 'mailing_traces')
//            ->withPivot('status', 'sent_at')
            ->withTimestamps();
    }

    public function groups(): BelongsToMany
    {
        return $this->belongsToMany(Group::class, 'lead_groups')
            ->withTimestamps();
    }
    
    public function traces(): HasMany
    {
        return $this->hasMany(MailingTrace::class);
    }

}
