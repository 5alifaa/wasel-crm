<?php

namespace App\Filament\Resources\Mailings\Pages;

use App\Filament\Resources\Mailings\MailingResource;
use Filament\Actions\Action;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewMailing extends ViewRecord
{
    protected static string $resource = MailingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('send')
                ->label('Send Mailing')
                ->action(function () {
//                    (new SendMailing())->handle($this->record);
                })
                ->requiresConfirmation()
                ->color('success'),
            EditAction::make(),
        ];
    }
}
