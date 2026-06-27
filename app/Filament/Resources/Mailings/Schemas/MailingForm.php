<?php

namespace App\Filament\Resources\Mailings\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
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
                TextInput::make('status')
                    ->required()
                    ->default('draft'),
                TextInput::make('email_from')
                    ->email()
                    ->required(),
                Textarea::make('recipients')
                    ->required()
                    ->columnSpanFull(),
            ]);
    }
}
