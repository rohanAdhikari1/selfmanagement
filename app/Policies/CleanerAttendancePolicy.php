<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\CleanerAttendance;
use Illuminate\Auth\Access\HandlesAuthorization;

class CleanerAttendancePolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:CleanerAttendance');
    }

    public function view(AuthUser $authUser, CleanerAttendance $cleanerAttendance): bool
    {
        return $authUser->can('View:CleanerAttendance');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:CleanerAttendance');
    }

    public function update(AuthUser $authUser, CleanerAttendance $cleanerAttendance): bool
    {
        return $authUser->can('Update:CleanerAttendance');
    }

    public function delete(AuthUser $authUser, CleanerAttendance $cleanerAttendance): bool
    {
        return $authUser->can('Delete:CleanerAttendance');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:CleanerAttendance');
    }

}