<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CleanerTaskReport extends Model
{
    protected $fillable = [
        'cleaner_id',
        'site_id',
        'attendance_id',
        'task_id',
        'start_time',
        'finish_time',
    ];

    public function site()
    {
        return $this->belongsTo(Site::class, 'site_id');
    }

    public function task()
    {
        return $this->belongsTo(Task::class, 'task_id');
    }
}
