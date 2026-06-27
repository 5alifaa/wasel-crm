<?php

declare(strict_types=1);

namespace App\Filament\Resources\Mailings;

use App\Actions\SendMailing;
use App\Filament\Resources\Mailings\Pages\CreateMailing;
use App\Filament\Resources\Mailings\Pages\EditMailing;
use App\Filament\Resources\Mailings\Pages\ListMailings;
use App\Filament\Resources\Mailings\Pages\ViewMailing;
use App\Filament\Resources\Mailings\RelationManagers\LeadsRelationManager;
use App\Filament\Resources\Mailings\Schemas\MailingForm;
use App\Filament\Resources\Mailings\Schemas\MailingInfolist;
use App\Filament\Resources\Mailings\Tables\MailingsTable;
use App\Models\Mailing;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use Override;

class MailingResource extends Resource
{
    protected static ?string $model = Mailing::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'Mailings';

    #[Override]
    public static function form(Schema $schema): Schema
    {
        return MailingForm::configure($schema);
    }

    #[Override]
    public static function infolist(Schema $schema): Schema
    {
        return MailingInfolist::configure($schema);
    }

    #[Override]
    public static function table(Table $table): Table
    {
        return MailingsTable::configure($table);
    }

    #[Override]
    public static function getRelations(): array
    {
        return [
            LeadsRelationManager::class,
        ];
    }

    #[Override]
    public static function getPages(): array
    {
        return [
            'index' => ListMailings::route('/'),
            'create' => CreateMailing::route('/create'),
            'view' => ViewMailing::route('/{record}'),
            'edit' => EditMailing::route('/{record}/edit'),
        ];
    }

    public static function getSendMailingAction(): Action
    {
        return Action::make('send')
            ->label('Send Mailing')
            ->action(function (Model $record) {
                // recipients string to array
                (new SendMailing)->handle($record->id);
                Notification::make()
                    ->title('Mailing sent!')
                    ->success()
                    ->send();

            })
            ->color('success');
    }
}
