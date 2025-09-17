<?php

namespace App\Models;

use App\DataManagerTrait;
use Illuminate\Database\Eloquent\Model;

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
