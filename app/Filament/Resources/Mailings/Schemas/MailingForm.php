<?php

namespace App\Filament\Resources\Mailings\Schemas;

use App\MailingStatus;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
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
                Textarea::make('body')
                    ->required()
                    ->columnSpanFull(),
                Select::make('status')
                    ->options(MailingStatus::class)
                    ->required()
                    ->default(MailingStatus::DRAFT),
                TextInput::make('email_from')
                    ->email()
                    ->required(),
                Textarea::make('recipients')
                    ->required()
                    ->columnSpanFull(),
            ]);
    }
}
