<?php

namespace App\Filament\Pages;

use App\Livewire\CleanerReportInfoList;
use App\Models\Cleaner;
use App\Models\CleanerTaskReport as ModelsCleanerTaskReport;
use App\Models\Site;
use Filament\Pages\Page;
use Filament\Support\Enums\Width;
use Illuminate\Contracts\Support\Htmlable;
use Livewire\Attributes\Url;

class CleanerTaskReport extends Page
{
    protected static bool $shouldRegisterNavigation = false;

    protected static ?string $slug = 'cleaner-task-report';

    protected string $view = 'filament.pages.cleaner-task-report';

    public $records;

    #[Url]
    public $cleaner;

    #[Url]
    public $site;

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
        Cleaner::findOrFail($this->cleaner);
        Site::findOrFail($this->site);
        $this->records = ModelsCleanerTaskReport::where('site_id', $this->site)->where('cleaner_id', $this->cleaner)->get();
    }
}
