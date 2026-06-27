<?php

namespace App\Filament\Resources\Mailings\Schemas;

use App\MailingStatus;
use App\Models\Lead;
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
                Select::make('recipients')
                    ->options(Lead::pluck('name', 'id'))
                    ->multiple()
                    ->required()
                    ->searchable()
                    ->getSearchResultsUsing(function (string $search) {
                        return Lead::where('name', 'like', "%{$search}%")
                            ->orWhere('email', 'like', "%{$search}%")
                            ->pluck('name', 'id');
                    })
            ]);
    }
}
