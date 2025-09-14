<?php

namespace App\Livewire;

use App\Models\Inspectionreport;
use Livewire\Component;

class InspectionSurvey extends Component
{
    public function mount($report)
    {
        $report = Inspectionreport::where('report_number', $report)->firstOrFail();
    }

    public function render()
    {
        return view('livewire.inspection-survey');
    }
}
