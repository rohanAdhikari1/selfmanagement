<?php

namespace App\Filament\Resources\CompanyUsers;

use App\Filament\Resources\Companies\CompanyResource;
use App\Filament\Resources\CompanyUsers\Pages\CreateCompanyUser;
use App\Filament\Resources\CompanyUsers\Pages\EditCompanyUser;
use App\Filament\Resources\CompanyUsers\Pages\ListCompanyUsers;
use App\Filament\Resources\CompanyUsers\Pages\ViewCompanyUser;
use App\Filament\Resources\CompanyUsers\Schemas\CompanyUserForm;
use App\Filament\Resources\CompanyUsers\Schemas\CompanyUserInfolist;
use App\Filament\Resources\CompanyUsers\Tables\CompanyUsersTable;
use App\Models\CompanyUser;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class CompanyUserResource extends Resource
{
    protected static ?string $model = CompanyUser::class;

    protected static ?string $modelLabel = 'Client Users';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::Users;

    protected static ?string $recordTitleAttribute = 'full_name';

    protected static string|UnitEnum|null $navigationGroup = 'User Management';

    public static function form(Schema $schema): Schema
    {
        return CompanyUserForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return CompanyUserInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CompanyUsersTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListCompanyUsers::route('/'),
            'create' => CreateCompanyUser::route('/create'),
            'view' => ViewCompanyUser::route('/{record}'),
            'edit' => EditCompanyUser::route('/{record}/edit'),
        ];
    }
}
