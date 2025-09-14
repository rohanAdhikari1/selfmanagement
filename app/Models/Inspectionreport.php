<?php

namespace App\Models;

use App\DataManagerTrait;
use Illuminate\Database\Eloquent\Model;

class Inspectionreport extends Model
{
    use DataManagerTrait;

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
            $lastReportNumber = self::max('report_number') ?? 0;
            $newNumber = $lastReportNumber + 1;
            $report->report_number = 'REP-' . str_pad($newNumber, 4, '0', STR_PAD_LEFT);
        });
    }

    public function items()
    {
        return $this->hasMany(InspectionreportItem::class, 'inspection_report_id');
    }

    public function site()
    {
        return $this->belongsTo(Site::class, 'site_id');
    }
}
