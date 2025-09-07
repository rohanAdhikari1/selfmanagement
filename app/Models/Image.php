<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Image extends Model
{
    protected $fillable = [
        'title',
        'description',
        'file_path',
        'file_name',
        'file_size',
        'longitude',
        'latitude',
        'model_type',
        'model_id',
        'is_before'
    ];

    public function model()
    {
        return $this->morphTo();
    }

    protected static function booted()
    {
        static::deleting(function ($image) {
            if ($image->file_path && Storage::exists($image->file_path)) {
                Storage::delete($image->file_path);
            }
        });
    }
}
