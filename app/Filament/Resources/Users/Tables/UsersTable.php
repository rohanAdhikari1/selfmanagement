<?php

namespace App\Filament\Resources\Users\Tables;

use Filament\Actions\ActionGroup;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class UsersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('SN')
                    ->rowIndex()
                    ->sortable(),
                TextColumn::make('full_name')
                    ->searchable(),
                TextColumn::make('roles.name')
                    ->label('Roles')
                    ->badge()
                    ->formatStateUsing(function ($state) {
                        return collect(explode(',', $state))
                            ->map(fn($role) => Str::title(str_replace('_', ' ', trim($role))))
                            ->join(', ');
                    })
                    ->searchable(),
                TextColumn::make('email')
                    ->label('Email address')
                    ->searchable(),
                TextColumn::make('username')
                    ->searchable(),
                TextColumn::make('phone')
                    ->searchable(),
                IconColumn::make('is_active')
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
                ActionGroup::make([
                    // Tables\Actions\Action::make('toggleStatus')
                    //     ->label(fn(User $record) => $record->is_active ? 'Deactivate' : 'Activate')
                    //     ->action(function (User $record) {
                    //         $record->update([
                    //             'is_active' => !$record->is_active,
                    //         ]);
                    //     })
                    //     ->icon(fn(User $record) => $record->is_active ? 'heroicon-s-x-circle' : 'heroicon-s-check')
                    //     ->color(fn(User $record) => $record->is_active ? 'danger' : 'success'),
                    // Tables\Actions\Action::make('reset-password')
                    //     ->visible(function ($record) {
                    //         return auth()->user()->hasRole('super_admin') || (!($record->hasRole('admin') || $record->hasRole('super_admin')) && auth()->user()->id !== $record->id);
                    //     })
                    //     ->label('Reset Password')
                    //     ->icon('heroicon-o-key')
                    //     ->modalHeading('Reset Password')
                    //     ->form([
                    //         Forms\Components\TextInput::make('new_password')
                    //             ->label('New Password')
                    //             ->password()
                    //             ->required()
                    //             ->revealable()
                    //             ->minLength(8),
                    //         Forms\Components\TextInput::make('new_password_confirmation')
                    //             ->label('Confirm New Password')
                    //             ->password()
                    //             ->revealable()
                    //             ->required()
                    //             ->same('new_password'),
                    //     ])
                    //     ->action(function ($record, $data) {
                    //         $record->forceFill([
                    //             'password' => Hash::make($data['new_password'])
                    //         ])->setRememberToken(Str::random(60));

                    //         $record->save();
                    //         Notification::make()
                    //             ->title('Password Reset successfully')
                    //             ->success()
                    //             ->send();
                    //     }),
                    ViewAction::make(),
                    // Tables\Actions\EditAction::make()->visible(function ($record) {
                    //     return auth()->user()->hasRole('super_admin') || (!($record->hasRole('admin') || $record->hasRole('super_admin')) && auth()->user()->id !== $record->id);
                    // }),
                    // Tables\Actions\DeleteAction::make()
                    //     ->visible(function ($record) {
                    //         return (auth()->user()->hasRole('super_admin') || !($record->hasRole('admin') || $record->hasRole('super_admin'))) && auth()->user()->id !== $record->id;
                    //     }),
                ]),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
