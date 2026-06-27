<?php

declare(strict_types=1);

namespace App;

enum LeadSource: string
{
    case FACEBOOK = 'facebook';
    case GOOGLE = 'google';
    case LINKEDIN = 'linkedin';
    case OTHER = 'other';

    public function label(): string
    {
        return match ($this) {
            self::FACEBOOK => 'Facebook',
            self::GOOGLE => 'Google',
            self::LINKEDIN => 'LinkedIn',
            self::OTHER => 'Other'
        };
    }
}
