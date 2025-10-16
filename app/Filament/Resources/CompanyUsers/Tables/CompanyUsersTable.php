<?php

namespace App\Filament\Resources\CompanyUsers\Tables;

use App\Models\CompanyUser;
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

class CompanyUsersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('full_name')
                    ->searchable(),
                TextColumn::make('company.name')
                    ->numeric()
                    ->sortable()
                    ->visible(fn($livewire) => $livewire instanceof \App\Filament\Resources\CompanyUsers\Pages\ListCompanyUsers),
                TextColumn::make('email')
                    ->label('Email address')
                    ->searchable(),
                TextColumn::make('username')
                    ->searchable(),
                TextColumn::make('phone')
                    ->searchable(),
                IconColumn::make('is_active')
                    ->boolean(),
                TextColumn::make('avatar')
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
                        ->label(fn(CompanyUser $record) => $record->is_active ? 'Deactivate' : 'Activate')
                        ->action(function (CompanyUser $record) {
                            $record->update([
                                'is_active' => !$record->is_active,
                            ]);
                        })
                        ->icon(fn(CompanyUser $record) => $record->is_active ? 'heroicon-s-x-circle' : 'heroicon-s-check')
                        ->color(fn(CompanyUser $record) => $record->is_active ? 'danger' : 'success'),
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
                ])
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
