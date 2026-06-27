<?php

namespace App\Filament\Resources\Mailings\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class MailingInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('subject'),
                TextEntry::make('body')
                    ->columnSpanFull(),
                TextEntry::make('status'),
                TextEntry::make('email_from'),
                TextEntry::make('recipients')
                    ->columnSpanFull(),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
