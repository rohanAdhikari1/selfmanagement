<?php

namespace App\Models;

use App\DataManagerTrait;
use Illuminate\Database\Eloquent\Model;

class UserEnrollment extends Model
{
    use DataManagerTrait;

    protected $fillable = [
        'user_id',
        'site_id',
        'remarks',
        'status',
        'from_time',
        'to_time',
    ];

    public function site()
    {
        return $this->belongsTo(Site::class, 'site_id');
    }

    public function activeCleaner()
    {
        return $this->belongsTo(Cleaner::class, 'user_id')->where('is_active', true);
    }

    public function cleaner()
    {
        return $this->belongsTo(Cleaner::class, 'user_id');
    }
}
