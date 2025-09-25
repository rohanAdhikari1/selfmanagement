<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\InspectionAnswerOption;
use Illuminate\Auth\Access\HandlesAuthorization;

class InspectionAnswerOptionPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:InspectionAnswerOption');
    }

    public function view(AuthUser $authUser, InspectionAnswerOption $inspectionAnswerOption): bool
    {
        return $authUser->can('View:InspectionAnswerOption');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:InspectionAnswerOption');
    }

    public function update(AuthUser $authUser, InspectionAnswerOption $inspectionAnswerOption): bool
    {
        return $authUser->can('Update:InspectionAnswerOption');
    }

    public function delete(AuthUser $authUser, InspectionAnswerOption $inspectionAnswerOption): bool
    {
        return $authUser->can('Delete:InspectionAnswerOption');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('DeleteAny:InspectionAnswerOption');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:InspectionAnswerOption');
    }

}