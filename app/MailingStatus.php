<?php

declare(strict_types=1);

namespace App;

enum MailingStatus: string
{
    case DRAFT = 'draft';
    case IN_QUEUE = 'in_queue';
    case SENDING = 'sending';
    case DONE = 'done';

    case DONE_WITH_ERROR = 'done_with_error';

    public function label(): string
    {
        return match ($this) {
            self::DRAFT => 'Draft',
            self::IN_QUEUE => 'In Queue',
            self::SENDING => 'Sending',
            self::DONE => 'Done',
            self::DONE_WITH_ERROR => 'Done with Error',
        };
    }
}
