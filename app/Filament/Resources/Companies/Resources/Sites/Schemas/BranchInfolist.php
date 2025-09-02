<?php

namespace App\Filament\Resources\Companies\Resources\Branches\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class BranchInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('uid'),
                TextEntry::make('company_id')
                    ->numeric(),
                TextEntry::make('name'),
                TextEntry::make('tax_id'),
                TextEntry::make('phone'),
                TextEntry::make('email')
                    ->label('Email address'),
                TextEntry::make('address1'),
                TextEntry::make('address2'),
                TextEntry::make('created_by')
                    ->numeric(),
                TextEntry::make('updated_by')
                    ->numeric(),
                TextEntry::make('created_at')
                    ->dateTime(),
                TextEntry::make('updated_at')
                    ->dateTime(),
            ]);
    }
}
