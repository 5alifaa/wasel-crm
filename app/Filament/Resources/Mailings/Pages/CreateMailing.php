<?php

declare(strict_types=1);

namespace App\Filament\Resources\Mailings\Pages;

use App\Filament\Resources\Mailings\MailingResource;
use Filament\Resources\Pages\CreateRecord;

class CreateMailing extends CreateRecord
{
    protected static string $resource = MailingResource::class;
}
