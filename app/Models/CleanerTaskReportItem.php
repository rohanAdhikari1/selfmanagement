<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CleanerTaskReportItem extends Model
{

    protected $fillable = [
        'report_id',
        'task_id',
        'start_time',
        'finish_time',
        'start_longitude',
        'start_latitude',
        'finish_longitude',
        'finish_latitude',
    ];


    public function report()
    {
        return $this->belongsTo(CleanerTaskReport::class, 'report_id');
    }

    public function task()
    {
        return $this->belongsTo(Task::class, 'task_id');
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'model');
    }

    public function images_before()
    {
        return $this->morphMany(Image::class, 'model')->where('is_before', true);
    }

    public function images_after()
    {
        return $this->morphMany(Image::class, 'model')->where('is_before', false);
    }
}
