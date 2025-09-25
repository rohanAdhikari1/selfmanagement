<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CleanerTaskReport extends Model
{
    protected $fillable = [
        'pdf_path',
        'cleaner_id',
        'site_id',
        'attendance_id',
    ];

    public function site()
    {
        return $this->belongsTo(Site::class, 'site_id');
    }

    public function cleaner()
    {
        return $this->belongsTo(Cleaner::class, 'cleaner_id');
    }

    public function items()
    {
        return $this->hasMany(CleanerTaskReportItem::class, 'report_id');
    }
}
