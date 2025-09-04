<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;

class CompanyUser extends User
{
    protected $guarded = [];

    protected $table = 'users';

    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope('user', function (Builder $builder) {
            $builder->whereHas('user', function ($query) {
                $query->role('company_user');
            });
        });
        static::creating(function ($company_user) {
            $company_user->user->assignRole('company_user');
        });
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'id');
    }

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }
}
