<?php

namespace App\Models;

use App\DataManagerTrait;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use DataManagerTrait;

    protected $fillable = [
        'name',
        'description',
        'order',
        'created_by',
        'updated_by'
    ];

    public function inspectionQuestions()
    {
        return $this->hasMany(InspectionQuestion::class, 'task_id');
    }
}
