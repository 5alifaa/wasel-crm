<?php

declare(strict_types=1);

namespace App\Filament\Resources\MailingTraces;

use App\Filament\Resources\MailingTraces\Pages\ManageMailingTraces;
use App\MailingTraceStatus;
use App\Models\MailingTrace;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Override;

class MailingTraceResource extends Resource
{
    protected static ?string $model = MailingTrace::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'Mailing Traces';

    #[Override]
    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('mailing_id')
                    ->relationship('mailing', 'id')
                    ->required(),
                Select::make('lead_id')
                    ->relationship('lead', 'name')
                    ->required(),
                Select::make('status')
                    ->options(MailingTraceStatus::class)
                    ->default('pending')
                    ->required(),
                DateTimePicker::make('sent_at'),
                DateTimePicker::make('error_at'),
            ]);
    }

    #[Override]
    public static function infolist(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('mailing.id')
                    ->label('Mailing'),
                TextEntry::make('lead.name')
                    ->label('Lead'),
                TextEntry::make('status')
                    ->badge(),
                TextEntry::make('sent_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('error_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }

    #[Override]
    public static function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('Mailing Traces')
            ->columns([
                TextColumn::make('mailing.id')
                    ->searchable(),
                TextColumn::make('lead.name')
                    ->searchable(),
                TextColumn::make('status')
                    ->badge()
                    ->searchable(),
                TextColumn::make('sent_at')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('error_at')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
                //                EditAction::make(),
                //                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    #[Override]
    public static function getPages(): array
    {
        return [
            'index' => ManageMailingTraces::route('/'),
        ];
    }
}
