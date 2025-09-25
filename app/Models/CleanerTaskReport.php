<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class CleanerTaskReport extends Model
{

    public function getRouteKeyName()
    {
        return 'report_number';
    }

    protected $fillable = [
        'report_number',
        'pdf_path',
        'cleaner_id',
        'site_id',
        'attendance_id',
    ];

    protected static function booted()
    {
        static::creating(function ($report) {
            $lastReportNumber = self::max('report_number');

            if ($lastReportNumber) {
                $number = (int) preg_replace('/[^0-9]/', '', $lastReportNumber);
            } else {
                $number = 0;
            }

            $newNumber = $number + 1;
            $report->report_number = 'REP-' . str_pad($newNumber, 4, '0', STR_PAD_LEFT);
        });
        static::deleting(function ($report) {
            if ($report->pdf_path && Storage::exists($report->pdf_path)) {
                Storage::delete($report->pdf_path);
            }
        });
    }

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
