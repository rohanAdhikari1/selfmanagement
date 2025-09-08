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
        'created_by',
        'updated_by',
    ];

    public function items()
    {
        return $this->hasMany(InspectionreportItem::class, 'inspection_report_id');
    }

    public function site()
    {
        return $this->belongsTo(Site::class, 'site_id');
    }
}
