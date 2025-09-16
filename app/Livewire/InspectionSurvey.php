<?php

namespace App\Livewire;

use App\Models\Inspectionreport;
use Livewire\Attributes\On;
use Livewire\Component;

class InspectionSurvey extends Component
{
    public array $tempId = [];
    public array $tempImages = [];
    public array $tempLocation = [];

    #[On('image-uploaded')]
    public function flutterChannelStatus($record_id, $images)
    {
        $this->tempImages = $images;
        $this->tempId = $record_id;
    }

    // public function imp(){
    //     foreach ($images as $imgData) {
    //         // Decode base64
    //         $fileContent = base64_decode($imgData['file_base64']);

    //         // Generate unique file name
    //         $uniqueFileName = Str::uuid()->toString() . '.jpg';

    //         // Store in storage/app/report_images/finish
    //         $path = 'report_images/finish/' . $uniqueFileName;
    //         Storage::put($path, $fileContent);

    //         // Save in DB
    //         Image::create([
    //             'title' => $report->task->name . ' Image',
    //             'description' => $report->task->name . ' Image for report',
    //             'file_path' => $path,
    //             'file_name' => $uniqueFileName,
    //             'file_size' => strlen($fileContent), // size in bytes
    //             'longitude' => $imgData['position']['longitude'] ?? null,
    //             'latitude' => $imgData['position']['latitude'] ?? null,
    //             'model_type' => CleanerTaskReport::class,
    //             'model_id' => $report->id,
    //             'is_before' => true,
    //         ]);
    //     }
    // }

    public function mount($report)
    {
        $report = Inspectionreport::where('report_number', $report)->firstOrFail();
    }

    public function render()
    {
        return view('livewire.inspection-survey');
    }
}
