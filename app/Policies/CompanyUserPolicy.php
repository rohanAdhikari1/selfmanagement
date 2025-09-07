<?php

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use Illuminate\Auth\Access\HandlesAuthorization;

class CompanyUserPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:CompanyUser');
    }

    public function view(AuthUser $authUser): bool
    {
        return $authUser->can('View:CompanyUser');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:CompanyUser');
    }

    public function update(AuthUser $authUser): bool
    {
        return $authUser->can('Update:CompanyUser');
    }

    public function delete(AuthUser $authUser): bool
    {
        return $authUser->can('Delete:CompanyUser');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:CompanyUser');
    }

}