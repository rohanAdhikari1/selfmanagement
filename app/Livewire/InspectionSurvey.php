<?php

namespace App\Livewire;

use App\Models\Image;
use App\Models\InspectionAnswerOption;
use App\Models\InspectionQuestion;
use App\Models\Inspectionreport;
use App\Models\InspectionreportItem;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Component;
use Illuminate\Support\Str;

class InspectionSurvey extends Component
{
    public array $answerOptions = [];
    public array $items = [];
    public array $questions = [];
    public string $draftMessage = '';

    public ?string $signature = null;

    #[Locked]
    public Inspectionreport $report;

    #[On('image-uploaded')]
    public function flutterChannelStatus($record_id, $images, $position)
    {
        $item = InspectionreportItem::firstOrCreate(
            [
                'inspectionreport_id' => $this->report->id,
                'question_id' => $record_id,
            ],
            [
                'answer_id'      => null,
                'remarks'        => null,
                'obtained_point' => 0,
                'is_active'      => true,
            ]
        );
        foreach ($images as $imgData) {
            $fileContent = base64_decode($imgData);
            $uniqueFileName = Str::uuid()->toString() . '.jpg';
            $path = 'inspection_images/' . $this->report->report_number . '/' . $uniqueFileName;
            Storage::put($path, $fileContent);
            Image::create([
                'title' => $this->report->title . ' Image',
                'description' => $this->report->title . ' Image for Inspection report',
                'file_path' => $path,
                'file_name' => $uniqueFileName,
                'file_size' => strlen($fileContent),
                'longitude' => $position['longitude'],
                'latitude' => $position['latitude'],
                'model_type' => InspectionreportItem::class,
                'model_id' => $item->id,
            ]);
        }
        $this->loadDraft();
        $this->draftMessage = "Draft saved Last at " . now()->format('H:i:s');
    }

    public function mount()
    {
        $this->answerOptions = InspectionAnswerOption::where('is_active', true)->select('id', 'name', 'point_percentage')
            ->get()
            ->keyBy('id')->toArray();
        $this->loadDraft();
    }

    public function deleteImage($imageId)
    {
        $image = Image::find($imageId);
        if ($image && $image->model_type === InspectionreportItem::class) {
            $image->delete();
        }
        $this->loadDraft();
    }

    public function save()
    {
        sleep(5);
        dd($this->signature);
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
                'images'    => $existing?->images?->map(fn($img) => [
                    'id'   => $img->id,
                    'url'  => Storage::temporaryUrl($img->file_path, now()->addMinutes(5)),
                ])->toArray() ?? [],
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
        $this->draftMessage = "Draft saved Last at " . now()->format('H:i:s');
    }

    public function render()
    {
        return view('livewire.inspection-survey');
    }
}
