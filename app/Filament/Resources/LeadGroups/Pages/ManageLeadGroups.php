<?php

namespace App\Filament\Resources\LeadGroups\Pages;

use App\Filament\Resources\LeadGroups\LeadGroupResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;

class ManageLeadGroups extends ManageRecords
{
    protected static string $resource = LeadGroupResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
