<?php

namespace App\Filament\Resources\UserEnrollments\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class UserEnrollmentsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(function ($query) {
                if (auth()->user()->hasRole('company_user')) {
                    $query->whereHas('site', function ($q) {
                        $q->where('company_id', auth()->user()->company_id);
                    });
                }
            })
            ->columns([
                TextColumn::make('cleaner.full_name')
                    ->searchable(),
                TextColumn::make('site.name')
                    ->searchable(),
                TextColumn::make('from_time')
                    ->label('Expected From Time')
                    ->time()
                    ->sortable(),
                TextColumn::make('to_time')
                    ->label('Expected To Time')
                    ->time()
                    ->sortable(),
                IconColumn::make('status')
                    ->boolean(),
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
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
