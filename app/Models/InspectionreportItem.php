<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InspectionreportItem extends Model
{
    protected $guarded = [];

    public function question()
    {
        return $this->belongsTo(InspectionQuestion::class, 'question_id');
    }

    public function answer()
    {
        return $this->belongsTo(InspectionAnswerOption::class, 'answer_id');
    }
}
