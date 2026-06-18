<?php

namespace App;

enum MailingTraceStatus: string
{
    case PENDING = 'pending';
    case SENT = 'sent';
    case ERROR = 'error';
}
