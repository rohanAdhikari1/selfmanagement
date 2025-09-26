<?php

namespace App\Models;

use App\DataManagerTrait;
use Illuminate\Database\Eloquent\Model;

class CompanyInspectionQuestionException extends Model
{
    use DataManagerTrait;

    public $guarded = [];

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    public function inspectionQuestion()
    {
        return $this->belongsTo(InspectionQuestion::class, 'question_id');
    }
}
