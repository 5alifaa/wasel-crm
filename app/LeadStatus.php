<?php

namespace App;

enum LeadStatus: string
{
    case NEW = 'new';
    case CUSTOMER = 'customer';
    case LOST = 'lost';

    public function label(): string
    {
        return match ($this) {
            self::NEW => 'New',
            self::CUSTOMER => 'Customer',
            self::LOST => 'Lost'
        };
    }
}
