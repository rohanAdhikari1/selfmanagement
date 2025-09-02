<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CleanerTaskReport extends Model
{
    protected $fillable = [
        'cleaner_id',
        'site_id',
        'attendance_id',
    ];
}
