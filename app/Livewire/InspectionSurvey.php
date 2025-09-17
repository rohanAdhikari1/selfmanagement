<?php

namespace App\Livewire;

use App\Models\InspectionAnswerOption;
use App\Models\InspectionQuestion;
use App\Models\Inspectionreport;
use App\Models\InspectionreportItem;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Component;

class InspectionSurvey extends Component
{
    public array $answerOptions = [];
    public array $items = [];
    public array $questions = [];
    public string $draftMessage = '';

    #[Locked]
    public Inspectionreport $report;

    public int $tempId;
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

    public function mount()
    {
        $this->answerOptions = InspectionAnswerOption::where('is_active', true)->select('id', 'name', 'point_percentage')
            ->get()
            ->keyBy('id')->toArray();
        $this->loadDraft();
    }

    public function loadDraft()
    {
        $this->questions = InspectionQuestion::with('task')->get()->toArray();
        foreach ($this->questions as $q) {
            $existing = InspectionreportItem::where('inspectionreport_id', $this->report->id)
                ->where('question_id', $q['id'])
                ->first();
            $this->items[$q['id']] = [
                'answer_id' => $existing->answer_id ?? null,
                'remarks'   => $existing->remarks ?? null,
            ];
        }
    }

    public function updatedItems($value, $key)
    {
        [$questionId, $field] = explode('.', $key);
        $answerId = $this->items[$questionId]['answer_id'] ?? null;
        $remarks  = $this->items[$questionId]['remarks'] ?? null;
        $question = InspectionQuestion::find($questionId);
        $totalPoint = $question?->total_point ?? 0;
        $points = 0;
        if ($answerId && isset($this->answerOptions[$answerId])) {
            $percentage = $this->answerOptions[$answerId]['point_percentage'];
            $points = intval(($totalPoint * $percentage) / 100);
        }
        InspectionreportItem::updateOrCreate(
            [
                'inspectionreport_id' => $this->report->id,
                'question_id'         => $questionId,
            ],
            [
                'answer_id'      => $answerId,
                'remarks'        => $remarks,
                'obtained_point' => $points,
                'is_active'      => true
            ]
        );
        $this->draftMessage = "Draft saved at " . now()->format('H:i:s');
    }

    public function render()
    {
        return view('livewire.inspection-survey');
    }
}
