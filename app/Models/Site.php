<?php

namespace App\Models;

use App\DataManagerTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Site extends Model
{
    use DataManagerTrait;

    protected $fillable = [
        'uid',
        'name',
        'company_id',
        'tax_id',
        'phone',
        'email',
        'address1',
        'address2',
        'created_by',
        'updated_by',
    ];


    protected static function boot()
    {
        parent::boot();
        static::creating(function ($company) {
            if (empty($company->uid)) {
                $company->uid = Str::uuid()->toString();
            }
        });
    }

    public function enrollments()
    {
        return $this->hasMany(UserEnrollment::class, 'site_id');
    }

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }
}
