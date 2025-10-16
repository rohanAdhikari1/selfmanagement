<?php

namespace App\Filament\Resources\Cleaners\Tables;

use App\Models\Cleaner;
use Filament\Actions\Action;
use Filament\Actions\ActionGroup;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class CleanersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('full_name')
                    ->searchable(),
                TextColumn::make('email')
                    ->searchable(),
                TextColumn::make('username')
                    ->searchable(),
                TextColumn::make('phone')
                    ->searchable(),
                IconColumn::make('is_active')
                    ->boolean(),
                TextColumn::make('address1')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->searchable(),
                TextColumn::make('address2')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->searchable(),
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
                    Action::make('toggleStatus')
                        ->label(fn(Cleaner $record) => $record->is_active ? 'Deactivate' : 'Activate')
                        ->action(function (Cleaner $record) {
                            $record->update([
                                'is_active' => !$record->is_active,
                            ]);
                        })
                        ->icon(fn(Cleaner $record) => $record->is_active ? 'heroicon-s-x-circle' : 'heroicon-s-check')
                        ->color(fn(Cleaner $record) => $record->is_active ? 'danger' : 'success'),
                    Action::make('reset-password')
                        ->label('Reset Password')
                        ->icon('heroicon-o-key')
                        ->modalHeading('Reset Password')
                        ->schema([
                            TextInput::make('new_password')
                                ->label('New Password')
                                ->password()
                                ->required()
                                ->revealable()
                                ->minLength(8),
                            TextInput::make('new_password_confirmation')
                                ->label('Confirm New Password')
                                ->password()
                                ->revealable()
                                ->required()
                                ->same('new_password'),
                        ])
                        ->action(function ($record, $data) {
                            $record->forceFill([
                                'password' => Hash::make($data['new_password'])
                            ])->setRememberToken(Str::random(60));

                            $record->save();
                            Notification::make()
                                ->title('Password Reset successfully')
                                ->success()
                                ->send();
                        }),
                    ViewAction::make(),
                    EditAction::make(),
                ]),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
