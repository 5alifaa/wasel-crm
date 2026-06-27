<?php

namespace App\Filament\Resources\Leads\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class LeadInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('name'),
                TextEntry::make('phone'),
                TextEntry::make('email')
                    ->label('Email address'),
                TextEntry::make('country'),
                TextEntry::make('birth_date')
                    ->date(),
                TextEntry::make('status')
                    ->badge(),
                TextEntry::make('source')
                    ->badge(),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
//                Select::make('groups')
//                    ->relationship('groups', 'name')
//                    ->badge()
                TextEntry::make('groups.name')
                    ->label('Groups')
                    ->badge()
            ]);
    }
}
