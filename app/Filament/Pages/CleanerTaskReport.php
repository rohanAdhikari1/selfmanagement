<?php

namespace App\Filament\Pages;

use App\Models\CleanerTaskReport as ModelsCleanerTaskReport;
use BezhanSalleh\FilamentShield\Traits\HasPageShield;
use Filament\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Support\Enums\Width;
use Filament\Support\Icons\Heroicon;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\Facades\Storage;

class CleanerTaskReport extends Page
{
    use HasPageShield;

    protected static bool $shouldRegisterNavigation = false;

    protected static ?string $slug = 'cleaner-task-report/{record}';

    protected string $view = 'filament.pages.cleaner-task-report';

    public ModelsCleanerTaskReport $record;

    public function getMaxContentWidth(): Width
    {
        return Width::Full;
    }

    protected function getHeaderActions(): array
    {
        return [
            Action::make('report')
                ->label('Download')
                ->icon(Heroicon::Document)
                ->action(function () {
                    $path = $this->record->pdf_path;
                    if (filled($path) && Storage::fileExists($path)) {
                        return response()->download(Storage::temporaryUrl($path));
                    }
                    $this->dispatch('open-modal', id: 'report-missing');
                })
                ->keyBindings(['command+s', 'ctrl+s', 'command+p', 'ctrl+p',])
        ];
    }

    public function getTitle(): string | Htmlable
    {
        return __('Report Page');
    }

    public function mount() {}
}
