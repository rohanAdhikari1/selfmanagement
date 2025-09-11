<?php

namespace App\Filament\Pages;

use App\Livewire\CleanerReportInfoList;
use App\Models\CleanerTaskReport as ModelsCleanerTaskReport;
use Filament\Pages\Page;
use Filament\Support\Enums\Width;
use Illuminate\Contracts\Support\Htmlable;

class CleanerTaskReport extends Page
{
    protected static bool $shouldRegisterNavigation = false;

    protected static ?string $slug = 'cleaner-task-report';

    protected string $view = 'filament.pages.cleaner-task-report';

    public $records;

    public function getMaxContentWidth(): Width
    {
        return Width::Full;
    }

    public function getTitle(): string | Htmlable
    {
        return __('Report Page');
    }

    public function mount()
    {
        $this->records = ModelsCleanerTaskReport::all();
    }
}
