<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CleanerAttendance extends Model
{
    protected $fillable = [
        'cleaner_id',
        'enrollment_id',
        'start_time',
        'end_time',
        'remarks',
    ];

    public function cleaner()
    {
        return $this->belongsTo(Cleaner::class, 'cleaner_id');
    }

    public function enrollment()
    {
        return $this->belongsTo(UserEnrollment::class, 'enrollment_id');
    }
}
