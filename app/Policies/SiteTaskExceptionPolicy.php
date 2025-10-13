<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\SiteTaskException;
use Illuminate\Auth\Access\HandlesAuthorization;

class SiteTaskExceptionPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:SiteTaskException');
    }

    public function view(AuthUser $authUser, SiteTaskException $siteTaskException): bool
    {
        return $authUser->can('View:SiteTaskException');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:SiteTaskException');
    }

    public function update(AuthUser $authUser, SiteTaskException $siteTaskException): bool
    {
        return $authUser->can('Update:SiteTaskException');
    }

    public function delete(AuthUser $authUser, SiteTaskException $siteTaskException): bool
    {
        return $authUser->can('Delete:SiteTaskException');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('DeleteAny:SiteTaskException');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:SiteTaskException');
    }

}