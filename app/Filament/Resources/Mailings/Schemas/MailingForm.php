<?php

declare(strict_types=1);

namespace App\Filament\Resources\Mailings\Schemas;

use App\Filament\Resources\Leads\Tables\LeadsTable;
use App\MailingStatus;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\ModalTableSelect;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class MailingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('subject')
                    ->required(),
                MarkdownEditor::make('body')
                    ->toolbarButtons([
                        ['bold', 'italic', 'strike', 'link'],
                        ['heading'],
                        ['blockquote', 'codeBlock', 'bulletList', 'orderedList'],
                        ['table'],
                        ['undo', 'redo'],
                    ])
                    ->hint('You can use {{name}} or {{email}} to personalize the email.')
                    ->required()
                    ->columnSpanFull(),
                Select::make('status')
                    ->options(fn() => collect(MailingStatus::cases())->mapWithKeys(fn($status) => [$status->value => $status->label()]))
                    ->required()
                    ->default(MailingStatus::DRAFT),
                TextInput::make('email_from')
                    ->email()
                    ->required(),
                ModalTableSelect::make('client_id')
                    ->relationship('leads', 'name')
                    ->tableConfiguration(LeadsTable::class)
                    ->multiple()
            ]);
    }
}
