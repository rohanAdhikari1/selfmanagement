<?php

namespace App;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

trait DataManagerTrait
{
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updator()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function getCreatorNameAttribute()
    {
        return $this->creator->full_name ?? '-';
    }

    public function getUpdatorNameAttribute()
    {
        return $this->updator->full_name ?? '-';
    }


    protected static function bootDataManagerTrait()
    {
        static::creating(function ($model) {
            $model->created_by = Auth::id() ?? null;
            $model->updated_by = Auth::id() ?? null;
        });
        static::updating(function ($model) {
            $model->updated_by = Auth::id() ?? null;
        });
    }
}
