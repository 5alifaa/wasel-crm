<?php

namespace App\Filament\Resources\Mailings\Pages;

use App\Filament\Resources\Mailings\MailingResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewMailing extends ViewRecord
{
    protected static string $resource = MailingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            MailingResource::getSendMailingAction(),
            EditAction::make(),
        ];
    }
}
