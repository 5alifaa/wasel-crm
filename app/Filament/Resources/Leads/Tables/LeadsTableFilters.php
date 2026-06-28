<?php

namespace App\Filament\Resources\Leads\Tables;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;

class LeadsTableFilters
{
    public static function configure(): array
    {
        return [
            SelectFilter::make('status')
                ->options(fn() => collect(\App\LeadStatus::cases())->mapWithKeys(fn($status) => [$status->value => $status->label()])),
            SelectFilter::make('source')
                ->options(fn() => collect(\App\LeadSource::cases())->mapWithKeys(fn($source) => [$source->value => $source->label()])),
            SelectFilter::make('groups')
                ->relationship('groups', 'name')
                ->preload()
                ->searchable()
                ->multiple()
            ,
            // Birthdate filter
            Filter::make('birth_date')
                ->schema([
                    DatePicker::make('birth_date_from')
                        ->label('Birthdate from'),
                    DatePicker::make('birth_date_to')
                        ->label('Birthdate to'),
                ])
                ->query(function (Builder $query, array $data): Builder {
                    return $query
                        ->when(
                            $data['birth_date_from'],
                            fn(Builder $query, $date): Builder => $query->whereDate('birth_date', '>=', $date),
                        )
                        ->when(
                            $data['birth_date_to'],
                            fn(Builder $query, $date): Builder => $query->whereDate('birth_date', '<=', $date),
                        );
                }),
            // exact age filter
            Filter::make('age')
                ->schema([
                    TextInput::make('age')
                        ->numeric()
                        ->label('Age')
                ])
                ->query(function (Builder $query, array $data): Builder {
                    $ageYear = now()->subYears($data['age'])->year;
                    return $query->when(
                        $data['age'],
                        fn(Builder $query, $age): Builder => $query->whereYear('birth_date', $ageYear),
                    );

                }),
            // Day or Month
            Filter::make('birth_date_day')
                ->schema([
                    TextInput::make('birth_date_day')
                        ->numeric()
                        ->label('Birthdate Day')
                        ->minValue(1)
                        ->maxValue(31),
                ])
                ->query(function (Builder $query, array $data): Builder {
                    return $query->when(
                        $data['birth_date_day'],
                        fn(Builder $query, $day): Builder => $query->whereDay('birth_date', $day),
                    );
                }),
        ];
    }
}
