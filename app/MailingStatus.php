<?php

namespace App;

enum MailingStatus: string
{
    case DRAFT = 'draft';
    case IN_QUEUE = 'in_queue';
    case SENDING = 'sending';
    case DONE = 'done';
}
