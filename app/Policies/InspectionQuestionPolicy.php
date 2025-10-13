<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\InspectionQuestion;
use Illuminate\Auth\Access\HandlesAuthorization;

class InspectionQuestionPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:InspectionQuestion');
    }

    public function view(AuthUser $authUser, InspectionQuestion $inspectionQuestion): bool
    {
        return $authUser->can('View:InspectionQuestion');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:InspectionQuestion');
    }

    public function update(AuthUser $authUser, InspectionQuestion $inspectionQuestion): bool
    {
        return $authUser->can('Update:InspectionQuestion');
    }

    public function delete(AuthUser $authUser, InspectionQuestion $inspectionQuestion): bool
    {
        return $authUser->can('Delete:InspectionQuestion');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('DeleteAny:InspectionQuestion');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:InspectionQuestion');
    }

}