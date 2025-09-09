<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Actions\Action;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ToggleButtons;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('User Information')
                    ->icon('heroicon-o-user')
                    ->description('Enter the user\'s personal details.')
                    ->schema([
                        Grid::make(['default' => 1, 'md' => 3])
                            ->schema([
                                Grid::make(['default' => 1, 'md' => 2])
                                    ->schema([
                                        TextInput::make('full_name')
                                            ->label('Full Name')
                                            ->required()
                                            ->placeholder('John Doe')
                                            ->prefixIcon('heroicon-o-identification')
                                            ->maxLength(255),

                                        TextInput::make('email')
                                            ->unique(ignoreRecord: true)
                                            ->email()
                                            ->required()
                                            ->placeholder('user@example.com')
                                            ->prefixIcon('heroicon-o-envelope')
                                            ->maxLength(255),

                                        TextInput::make('phone')
                                            ->label('Phone Number')
                                            ->unique(ignoreRecord: true)
                                            ->tel()
                                            ->prefixIcon('heroicon-o-phone')
                                            ->placeholder('+1 (555) 123-4567')
                                            ->maxLength(255),

                                        ToggleButtons::make('is_active')
                                            ->label('Account Status')
                                            ->boolean()
                                            ->default(true)
                                            ->grouped()
                                            ->icons([
                                                true => 'heroicon-o-check-circle',
                                                false => 'heroicon-o-x-circle',
                                            ]),
                                    ])
                                    ->columnSpan(2),
                                FileUpload::make('avatar')
                                    ->label('Avatar')
                                    ->image()
                                    ->avatar()
                                    ->circleCropper()
                                    ->directory('users/avatars')
                                    ->openable()
                                    ->downloadable()
                                    ->imageEditor()
                                    ->moveFiles()
                                    ->helperText('Upload a clear profile photo.'),
                            ]),
                    ])
                    ->columnSpanFull(),

                Section::make('Account Security')
                    ->icon('heroicon-o-lock-closed')
                    ->description('Set login credentials for the user.')
                    ->schema([
                        Grid::make(['default' => 1, 'md' => 2])
                            ->schema([
                                TextInput::make('username')
                                    ->unique(ignoreRecord: true)
                                    ->required()
                                    ->prefixIcon('heroicon-o-user-circle')
                                    ->placeholder('johndoe')
                                    ->maxLength(255),

                                TextInput::make('password')
                                    ->password()
                                    ->label('Password')
                                    ->visibleOn('create')
                                    ->revealable()
                                    ->placeholder('Auto-generated if not provided')
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
                            ]),
                    ]),

                Section::make('Address Information')
                    ->icon('heroicon-o-map-pin')
                    ->description('User\'s address details.')
                    ->schema([
                        Grid::make(['default' => 1, 'md' => 2])
                            ->schema([
                                TextInput::make('address1')
                                    ->label('Address Line 1')
                                    ->prefixIcon('heroicon-o-home-modern')
                                    ->maxLength(255)
                                    ->placeholder('123 Main St'),

                                TextInput::make('address2')
                                    ->label('Address Line 2')
                                    ->prefixIcon('heroicon-o-map')
                                    ->maxLength(255)
                                    ->placeholder('Apt, Suite, etc.'),
                            ]),
                    ]),
                Section::make('User Role & Associations')
                    ->icon(Heroicon::ShieldCheck)
                    ->description('User\'s role and associations.')
                    ->columnSpanFull()
                    ->schema([
                        Grid::make(['default' => 1, 'md' => 2])
                            ->schema([
                                Select::make('roles')
                                    ->label('Roles')
                                    ->relationship('roles', 'name')
                                    ->getOptionLabelUsing(
                                        fn(array $values): array =>
                                        array_map(fn($value) => Str::title(str_replace('_', ' ', $value)), $values)
                                    )
                                    ->required()
                                    ->live()
                                    ->multiple()
                                    ->searchable()
                                    ->preload(),

                                Select::make('company_id')
                                    ->label('Company')
                                    ->relationship('company', 'name')
                                    ->visible(fn($get) => in_array('company_user', $get('roles') ?? []))
                                    ->searchable()
                                    ->preload(),

                                Select::make('site_id')
                                    ->label('Site')
                                    ->relationship('site', 'name')
                                    ->visible(fn($get) => in_array('site_user', $get('roles') ?? []))
                                    ->searchable()
                                    ->preload(),
                            ]),
                    ]),
            ]);
    }
}
