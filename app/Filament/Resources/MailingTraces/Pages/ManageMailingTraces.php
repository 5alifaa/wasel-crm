<?php

declare(strict_types=1);

namespace App\Filament\Resources\MailingTraces\Pages;

use App\Filament\Resources\MailingTraces\MailingTraceResource;
use Filament\Resources\Pages\ManageRecords;
use Override;

class ManageMailingTraces extends ManageRecords
{
    protected static string $resource = MailingTraceResource::class;

    #[Override]
    protected function getHeaderActions(): array
    {
        return [
            //            CreateAction::make(),
        ];
    }
}
