<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class CleanerAttendance extends Model
{
    protected $fillable = [
        'cleaner_id',
        'enrollment_id',
        'start_time',
        'end_time',
        'remarks',
        'entry_longitude',
        'entry_latitude',
        'exit_longitude',
        'exit_latitude',
        'entry_image_path',
        'exit_image_path',
    ];

    public function cleaner()
    {
        return $this->belongsTo(Cleaner::class, 'cleaner_id');
    }

    public function enrollment()
    {
        return $this->belongsTo(UserEnrollment::class, 'enrollment_id');
    }

    protected static function booted()
    {
        static::deleting(function ($attendance) {
            if ($attendance->entry_image_path && Storage::exists($attendance->entry_image_path)) {
                Storage::delete($attendance->entry_image_path);
            }
            if ($attendance->exit_image_path && Storage::exists($attendance->exit_image_path)) {
                Storage::delete($attendance->exit_image_path);
            }
        });
    }
}
