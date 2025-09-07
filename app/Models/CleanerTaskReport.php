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
        'start_longitude',
        'start_latitude',
        'finish_longitude',
        'finish_latitude',
    ];

    public function site()
    {
        return $this->belongsTo(Site::class, 'site_id');
    }

    public function task()
    {
        return $this->belongsTo(Task::class, 'task_id');
    }

    public function cleaner()
    {
        return $this->belongsTo(Cleaner::class, 'cleaner_id');
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
