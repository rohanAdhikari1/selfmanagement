<?php

namespace App\Models;

use App\DataManagerTrait;
use Illuminate\Database\Eloquent\Model;

class InspectionQuestion extends Model
{
    use DataManagerTrait;

    protected $fillable = [
        'task_id',
        'name',
        'description',
        'order',
        'total_point',
        'created_by',
        'updated_by',
    ];

    public function task()
    {
        return $this->belongsTo(Task::class, 'task_id');
    }
}
