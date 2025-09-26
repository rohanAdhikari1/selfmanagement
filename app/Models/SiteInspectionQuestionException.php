<?php

namespace App\Models;

use App\DataManagerTrait;
use Illuminate\Database\Eloquent\Model;

class SiteInspectionQuestionException extends Model
{
    use DataManagerTrait;
    public $guarded = [];

    public function site()
    {
        return $this->belongsTo(Site::class, 'site_id');
    }

    public function inspectionQuestion()
    {
        return $this->belongsTo(InspectionQuestion::class, 'question_id');
    }
}
