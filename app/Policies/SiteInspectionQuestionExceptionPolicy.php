<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\SiteInspectionQuestionException;
use Illuminate\Auth\Access\HandlesAuthorization;

class SiteInspectionQuestionExceptionPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:SiteInspectionQuestionException');
    }

    public function view(AuthUser $authUser, SiteInspectionQuestionException $siteInspectionQuestionException): bool
    {
        return $authUser->can('View:SiteInspectionQuestionException');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:SiteInspectionQuestionException');
    }

    public function update(AuthUser $authUser, SiteInspectionQuestionException $siteInspectionQuestionException): bool
    {
        return $authUser->can('Update:SiteInspectionQuestionException');
    }

    public function delete(AuthUser $authUser, SiteInspectionQuestionException $siteInspectionQuestionException): bool
    {
        return $authUser->can('Delete:SiteInspectionQuestionException');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('DeleteAny:SiteInspectionQuestionException');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:SiteInspectionQuestionException');
    }

}