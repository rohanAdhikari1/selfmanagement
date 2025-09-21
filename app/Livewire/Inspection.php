<?php

namespace App\Livewire;

use App\Models\Inspectionreport;
use App\Models\Site;
use Livewire\Attributes\Validate;
use Livewire\Component;
use TallStackUi\Traits\Interactions;

class Inspection extends Component
{
    use Interactions;

    #[Validate('required|string')]
    public $title = '';
    #[Validate('required|integer')]
    public $site = '';
    #[Validate('required|string')]
    public $frequency = '';

    public ?array $sites = null;

    public $frequencies = [
        'daily' => 'Daily',
        'weekly' => 'Weekly',
        'monthly' => 'Monthly',
        'quarterly' => 'Quarterly',
        'annually' => 'Annually',
    ];

    public function mount()
    {
        $this->sites = Site::select('id', 'name')->get()->toArray();
    }

    public function start()
    {
        // $this->go();
        // return;
        $this->validate();
        $existingReport = Inspectionreport::where('site_id', $this->site)
            ->whereDate('created_at', now()->toDateString())
            ->first();
        if (!$existingReport) {
            $this->go();
            return;
        }
        $this->dialog()
            ->warning('Warning!', 'Inspection for same Site on this date is already Available. Are you sure to inspect again?')
            ->confirm(method: 'go')
            ->cancel()
            ->send();
    }

    public function go()
    {
        $report = Inspectionreport::create([
            'title' => $this->title,
            'site_id' => $this->site,
            'frequency' => $this->frequency,
        ]);
        return $this->redirect(route('inspection.survey', ['report' => $report->report_number]));
        // return $this->redirect(route('inspection.survey', ['report' => 'REP-0001']), navigate: false);
    }

    public function render()
    {
        return view('livewire.inspection');
    }
}
