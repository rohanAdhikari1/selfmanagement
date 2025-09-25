<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\UserEnrollment;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserEnrollmentPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:UserEnrollment');
    }

    public function view(AuthUser $authUser, UserEnrollment $userEnrollment): bool
    {
        return $authUser->can('View:UserEnrollment');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:UserEnrollment');
    }

    public function update(AuthUser $authUser, UserEnrollment $userEnrollment): bool
    {
        return $authUser->can('Update:UserEnrollment');
    }

    public function delete(AuthUser $authUser, UserEnrollment $userEnrollment): bool
    {
        return $authUser->can('Delete:UserEnrollment');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('DeleteAny:UserEnrollment');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:UserEnrollment');
    }

}