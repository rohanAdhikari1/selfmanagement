<?php

namespace App\Filament\Resources\Cleaners\Schemas;

use Filament\Actions\Action;
use Illuminate\Support\Str;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Hash;

class CleanerForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('User Information')
                    ->description('Enter the user\'s personal details.')
                    ->schema([
                        Grid::make(['default' => 1, 'md' => 4])
                            ->columnSpan(5)
                            ->schema([
                                TextInput::make('full_name')
                                    ->label('Full Name')
                                    ->required()
                                    ->columnSpan(2)
                                    ->maxLength(255),

                                TextInput::make('username')
                                    ->unique(ignoreRecord: true)
                                    ->copyable()
                                    ->required()
                                    ->maxLength(255),

                                TextInput::make('abn_number')
                                    ->label('ABN Number')
                                    ->unique(ignoreRecord: true)
                                    ->required()
                                    ->maxLength(255),

                                TextInput::make('email')
                                    ->unique(ignoreRecord: true)
                                    ->email()
                                    ->required()
                                    ->columnSpan(2)
                                    ->maxLength(255),

                                TextInput::make('phone')
                                    ->label('Phone Number')
                                    ->unique(ignoreRecord: true)
                                    ->tel()
                                    ->prefixIcon('heroicon-o-phone')
                                    ->maxLength(255)
                                    ->columnSpan(2)
                                    ->default(null),
                            ]),
                        Grid::make(['default' => 1, 'md' => 2])
                            ->schema([
                                FileUpload::make('avatar')
                                    ->label('Profile')
                                    ->image()
                                    ->avatar()
                                    ->circleCropper()
                                    ->directory('users/avatars')
                                    ->openable()
                                    ->downloadable()
                                    ->imageEditor()
                                    ->moveFiles(),
                            ]),
                    ])
                    ->columns(6)
                    ->columnSpanFull(),

                Section::make('Account Security')
                    ->description('Set a secure password for the user.')
                    ->schema([
                        TextInput::make('password')
                            ->password()
                            ->label('Password')
                            ->visibleOn('create')
                            ->revealable()
                            ->default(fn() => Str::random(8))
                            ->autocomplete(false)
                            ->required()
                            ->prefixIcon('heroicon-m-shield-check')
                            ->suffixAction(
                                Action::make('regenerate')
                                    ->icon('heroicon-o-arrow-path')
                                    ->tooltip('Generate a new random password')
                                    ->action(fn(Set $set) => $set('password', Str::random(8)))
                            )
                            ->dehydrateStateUsing(fn(string $state): string => Hash::make($state))
                            ->maxLength(255),
                    ])->visibleOn('create'),

                Section::make('Address')
                    ->description('Address of Cleaner')
                    ->schema([
                        Grid::make(['default' => 1, 'md' => 2])
                            ->schema([
                                TextInput::make('address1')
                                    ->label('Address Line 1')
                                    ->maxLength(255)
                                    ->default(null),

                                TextInput::make('address2')
                                    ->label('Address Line 2')
                                    ->maxLength(255)
                                    ->default(null),
                            ]),
                    ]),
                Section::make('Documents')
                    ->description('Upload required documents.')
                    ->columnSpanFull()
                    ->schema([
                        Grid::make(['default' => 1, 'md' => 2])
                            ->schema([
                                FileUpload::make('police_report')
                                    ->label('Police Report')
                                    ->directory('users/documents/police_reports')
                                    ->acceptedFileTypes(['application/pdf', 'image/*'])
                                    ->openable()
                                    ->downloadable()
                                    ->moveFiles(),

                                FileUpload::make('official_document')
                                    ->label('Official Document')
                                    ->directory('users/documents/official_documents')
                                    ->acceptedFileTypes(['application/pdf', 'image/*'])
                                    ->openable()
                                    ->downloadable()
                                    ->moveFiles(),
                            ]),
                    ]),
            ]);
    }
}
