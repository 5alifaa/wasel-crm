<?php

namespace App\Filament\Resources\Mailings\RelationManagers;

use App\Filament\Resources\Leads\LeadResource;
use App\LeadStatus;
use Filament\Actions\AttachAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DetachAction;
use Filament\Actions\DetachBulkAction;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class LeadsRelationManager extends RelationManager
{
    protected static string $relationship = 'leads';

    protected static ?string $relatedResource = LeadResource::class;

    public function table(Table $table): Table
    {
        return $table
//            ->filters
            ->headerActions([
                // ...
                AttachAction::make()
                    ->preloadRecordSelect()
                    ->recordSelectSearchColumns(['name', 'email'])
                    ->multiple()
            ])
            ->recordActions([
                // ...
                DetachAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    // ...
                    DetachBulkAction::make(),
                ]),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->options(LeadStatus::cases())
            ]);
    }
}
