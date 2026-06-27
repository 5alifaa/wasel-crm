<?php

namespace App\Filament\Resources\MailingTraces\Pages;

use App\Filament\Resources\MailingTraces\MailingTraceResource;
use Filament\Resources\Pages\ManageRecords;

class ManageMailingTraces extends ManageRecords
{
    protected static string $resource = MailingTraceResource::class;

    protected function getHeaderActions(): array
    {
        return [
//            CreateAction::make(),
        ];
    }
}
