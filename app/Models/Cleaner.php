<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;

class Cleaner extends User
{
    protected $guarded = [];

    protected $table = 'users';

    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope('cleaner', function (Builder $builder) {
            $builder->whereHas('user', function ($query) {
                $query->role('cleaner');
            });
        });
        static::created(function ($cleaner) {
            $cleaner->user->assignRole('cleaner');
        });
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'id');
    }
}
