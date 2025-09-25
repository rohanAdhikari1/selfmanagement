<?php

namespace App\Filament\Resources\Sites\Tables;

use App\Enums\Role;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Facades\Filament;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class SitesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(function ($query) {
                if (Filament::auth()->user()->hasRole('company_user')) {
                    $query->where('company_id', Filament::auth()->user()->company_id);
                }
            })
            ->columns([
                TextColumn::make('name')
                    ->searchable(),
                TextColumn::make('company.name')
                    ->visible(fn($livewire) => $livewire instanceof \App\Filament\Resources\Sites\Pages\ListSites && !auth()->user()->hasRole(Role::COMPANY_USER))
                    ->searchable(),
                TextColumn::make('tax_id')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->searchable(),
                TextColumn::make('phone')
                    ->searchable(),
                TextColumn::make('email')
                    ->label('Email')
                    ->searchable(),
                TextColumn::make('creator_name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('updator_name')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->sortable(),
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
                SelectFilter::make('company_id')
                    ->label('Company')
                    ->relationship('company', 'name')
                    ->searchable()
                    ->hidden(auth()->user()->hasRole(Role::COMPANY_USER))
                    ->preload(),
            ])
            ->recordActions([
                Action::make('downloadQr')
                    ->label('Download QR')
                    ->icon(Heroicon::QrCode)
                    ->action(function ($record) {
                        $writer = new PngWriter();
                        $qrCode = new QrCode(
                            data: $record->uid,
                            size: 300,
                            margin: 10,
                        );
                        $result = $writer->write($qrCode);
                        $base64 = $result->getDataUri();
                        return view('filament.actions.company-qr-code-modal', [
                            'qr' => $base64,
                            'record' => $record,
                        ]);
                    }),
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
