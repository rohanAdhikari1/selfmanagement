<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InspectionAnswerOption extends Model
{
    protected $fillable = [
        'name',
        'description',
        'point_percentage',
        'color_code',
        'is_active',
        'created_by',
        'updated_by',
    ];
}
