<?php

namespace App\Models;

use App\DataManagerTrait;
use Illuminate\Database\Eloquent\Model;

class SiteTaskException extends Model
{
    use DataManagerTrait;
    public $guarded = [];

    public function site()
    {
        return $this->belongsTo(Site::class, 'site_id');
    }

    public function task()
    {
        return $this->belongsTo(Task::class, 'task_id');
    }
}
