<?php

namespace App\Models;

use App\DataManagerTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Inspectionreport extends Model
{
    use DataManagerTrait;

    public function getRouteKeyName()
    {
        return 'report_number';
    }

    protected $fillable = [
        'report_number',
        'title',
        'site_id',
        'inspection_type',
        'frequency',
        'is_active',
        'is_draft',
        'inspectionreport_id',
        'inspector_signature',
        'pdf_path',
        'created_by',
        'updated_by',
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

    public function items()
    {
        return $this->hasMany(InspectionreportItem::class, 'inspectionreport_id');
    }

    public function site()
    {
        return $this->belongsTo(Site::class, 'site_id');
    }
}
