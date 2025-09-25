<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\CleanerTaskReport;
use Illuminate\Auth\Access\HandlesAuthorization;

class CleanerTaskReportPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:CleanerTaskReport');
    }

    public function view(AuthUser $authUser, CleanerTaskReport $cleanerTaskReport): bool
    {
        return $authUser->can('View:CleanerTaskReport');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:CleanerTaskReport');
    }

    public function update(AuthUser $authUser, CleanerTaskReport $cleanerTaskReport): bool
    {
        return $authUser->can('Update:CleanerTaskReport');
    }

    public function delete(AuthUser $authUser, CleanerTaskReport $cleanerTaskReport): bool
    {
        return $authUser->can('Delete:CleanerTaskReport');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('DeleteAny:CleanerTaskReport');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:CleanerTaskReport');
    }

}