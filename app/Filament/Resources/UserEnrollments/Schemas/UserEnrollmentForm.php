<?php

namespace App\Filament\Resources\UserEnrollments\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TimePicker;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class UserEnrollmentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('user_id')
                    ->required()
                    ->label('Cleaner')
                    ->relationship('activeCleaner', 'full_name')
                    ->live()
                    ->afterStateUpdated(fn(callable $set) => $set('site_id', null))
                    ->partiallyRenderComponentsAfterStateUpdated(['site_id'])
                    ->searchable()
                    ->preload(),
                Select::make('site_id')
                    ->required()
                    ->relationship('site', 'name', function ($query, callable $get) {
                        $userId = $get('user_id');
                        $siteId = $get('site_id');
                        if ($userId) {
                            $query->where(function ($q) use ($userId, $siteId) {
                                $q->whereDoesntHave('enrollments', function ($q2) use ($userId) {
                                    $q2->where('user_id', $userId);
                                });
                                if ($siteId) {
                                    $q->orWhere('id', $siteId);
                                }
                            });
                        }
                    })
                    ->searchable()
                    ->preload()
                    ->getOptionLabelFromRecordUsing(fn($record) => "{$record->name} - {$record->company->name}"),
                Textarea::make('remarks')
                    ->default(null)
                    ->columnSpanFull(),
                TimePicker::make('from_time')
                    ->label('Expected From Time'),
                TimePicker::make('to_time')
                    ->label('Expected To Time'),
                Toggle::make('status')
                    ->default(true)
                    ->required()
            ]);
    }
}
