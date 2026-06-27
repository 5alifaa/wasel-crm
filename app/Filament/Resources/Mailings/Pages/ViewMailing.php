<?php

declare(strict_types=1);

namespace App\Filament\Resources\Mailings\Pages;

use App\Filament\Resources\Mailings\MailingResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;
use Override;

class ViewMailing extends ViewRecord
{
    protected static string $resource = MailingResource::class;

    #[Override]
    protected function getHeaderActions(): array
    {
        return [
            MailingResource::getSendMailingAction(),
            EditAction::make(),
        ];
    }
}
