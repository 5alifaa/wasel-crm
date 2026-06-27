<?php

declare(strict_types=1);

namespace App;

enum MailingStatus: string
{
    case DRAFT = 'draft';
    case IN_QUEUE = 'in_queue';
    case SENDING = 'sending';
    case DONE = 'done';

    public function label(): string
    {
        return match ($this) {
            self::DRAFT => 'Draft',
            self::IN_QUEUE => 'In Queue',
            self::SENDING => 'Sending',
            self::DONE => 'Done',
        };
    }
}
