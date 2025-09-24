<?php

namespace App\Livewire;

use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Concerns\InteractsWithSchemas;
use Filament\Schemas\Contracts\HasSchemas;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Livewire\Component;

class CleanerReportInfoList extends Component implements HasSchemas
{
    use InteractsWithSchemas;

    public $data;

    public function reportInfolist(Schema $schema): Schema
    {
        return $schema
            ->record($this->data)
            ->components([
                Section::make('Schedule')
                    ->icon(Heroicon::Clock)
                    ->schema([
                        TextEntry::make('start_time')
                            ->label('Start Time')
                            ->icon(Heroicon::Calendar),
                        TextEntry::make('finish_time')
                            ->label('Finish Time')
                            ->icon(Heroicon::Calendar),
                    ])->columns(2),
                Section::make('Metadata')
                    ->icon(Heroicon::InformationCircle)
                    ->schema([
                        TextEntry::make('created_at')
                            ->label('Created At')
                            ->icon(Heroicon::Clock),
                        TextEntry::make('updated_at')
                            ->label('Updated At')
                            ->icon(Heroicon::ArrowPath),
                    ])->columns(2),
                Section::make('Images')
                    ->icon(Heroicon::Camera)
                    ->schema([
                        ImageEntry::make('images_before.file_path')
                            ->label('Before')
                            ->stacked()
                            ->simpleLightbox(fn($image) => $image)
                            ->imageHeight(200),
                        ImageEntry::make('images_after.file_path')
                            ->label('After')
                            ->stacked()
                            ->imageHeight(200)
                            ->simpleLightbox(fn($image) => $image),
                    ])->columns(2)
                    ->columnSpanFull(),
            ])
            ->columns(2);
    }

    public function render()
    {
        return view('livewire.cleaner-report-info-list');
    }
}
