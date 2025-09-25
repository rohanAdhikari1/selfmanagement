<?php

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use Illuminate\Auth\Access\HandlesAuthorization;

class CleanerPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:Cleaner');
    }

    public function view(AuthUser $authUser): bool
    {
        return $authUser->can('View:Cleaner');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:Cleaner');
    }

    public function update(AuthUser $authUser): bool
    {
        return $authUser->can('Update:Cleaner');
    }

    public function delete(AuthUser $authUser): bool
    {
        return $authUser->can('Delete:Cleaner');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('DeleteAny:Cleaner');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:Cleaner');
    }

}