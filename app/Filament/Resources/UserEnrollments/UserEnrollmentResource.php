<?php

namespace App\Filament\Resources\UserEnrollments;

use App\Filament\Resources\UserEnrollments\Pages\CreateUserEnrollment;
use App\Filament\Resources\UserEnrollments\Pages\EditUserEnrollment;
use App\Filament\Resources\UserEnrollments\Pages\ListUserEnrollments;
use App\Filament\Resources\UserEnrollments\Pages\ViewUserEnrollment;
use App\Filament\Resources\UserEnrollments\Schemas\UserEnrollmentForm;
use App\Filament\Resources\UserEnrollments\Schemas\UserEnrollmentInfolist;
use App\Filament\Resources\UserEnrollments\Tables\UserEnrollmentsTable;
use App\Models\UserEnrollment;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class UserEnrollmentResource extends Resource
{
    protected static ?string $model = UserEnrollment::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::UserPlus;

    protected static ?string $modelLabel = 'Cleaner Enrollment';

    protected static ?int $navigationSort = 4;

    public static function form(Schema $schema): Schema
    {
        return UserEnrollmentForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return UserEnrollmentInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return UserEnrollmentsTable::configure($table);
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
            'index' => ListUserEnrollments::route('/'),
            'create' => CreateUserEnrollment::route('/create'),
            'view' => ViewUserEnrollment::route('/{record}'),
            'edit' => EditUserEnrollment::route('/{record}/edit'),
        ];
    }
}
