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
        static::addGlobalScope('user', function (Builder $builder) {
            // $builder->whereHas('user', function ($query) {
            // $query->role('user');
            // });
        });
        static::creating(function ($cleaner) {
            // $cleaner->user->assignRole('user');
        });
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'id');
    }
}
