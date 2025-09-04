<?php

namespace App\Models;

use App\DataManagerTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Company extends Model
{
    use DataManagerTrait;

    protected $fillable = [
        'uid',
        'name',
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

    public function sites()
    {
        return $this->hasMany(Site::class, 'company_id');
    }

    public function users()
    {
        return $this->hasMany(User::class, 'company_id');
    }
}
