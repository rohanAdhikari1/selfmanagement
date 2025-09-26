<?php

namespace App\Models;

use App\DataManagerTrait;
use Illuminate\Database\Eloquent\Model;

class CompanyTaskException extends Model
{
    use DataManagerTrait;

    public $guarded = [];

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    public function task()
    {
        return $this->belongsTo(Task::class, 'task_id');
    }
}
