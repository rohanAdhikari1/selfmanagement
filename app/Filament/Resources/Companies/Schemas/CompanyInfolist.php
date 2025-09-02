<?php

namespace App\Filament\Resources\Companies\Schemas;

use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;

class CompanyInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('name'),
                TextEntry::make('tax_id'),
                TextEntry::make('phone')
                    ->icon(Heroicon::Phone)
                    ->iconColor('primary'),
                TextEntry::make('email')
                    ->icon(Heroicon::Envelope)
                    ->iconColor('primary')
                    ->label('Email address'),
                TextEntry::make('address1'),
                TextEntry::make('address2'),
                TextEntry::make('creator_name'),
                TextEntry::make('updator_name'),
                TextEntry::make('created_at')
                    ->dateTime('M j, Y H:i:s'),
                TextEntry::make('updated_at')
                    ->dateTime('M j, Y H:i:s'),
                ImageEntry::make('qr_code')
                    ->label('QR Code')
                    ->state(function ($record) {
                        $writer = new PngWriter();

                        $qrCode = new QrCode(
                            data: $record->uid,
                            size: 300,
                            margin: 10,
                        );

                        $result = $writer->write($qrCode);

                        return $result->getDataUri();
                    })
                    ->extraImgAttributes([
                        'alt' => 'QR Code',
                        'style' => 'image-rendering: pixelated; width: 256px; height: 256px;',
                    ]),
            ]);
    }
}
