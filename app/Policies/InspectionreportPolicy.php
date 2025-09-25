<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\Inspectionreport;
use Illuminate\Auth\Access\HandlesAuthorization;

class InspectionreportPolicy
{
    use HandlesAuthorization;

    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:Inspectionreport');
    }

    public function view(AuthUser $authUser, Inspectionreport $inspectionreport): bool
    {
        return $authUser->can('View:Inspectionreport');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:Inspectionreport');
    }

    public function update(AuthUser $authUser, Inspectionreport $inspectionreport): bool
    {
        return $authUser->can('Update:Inspectionreport');
    }

    public function delete(AuthUser $authUser, Inspectionreport $inspectionreport): bool
    {
        return $authUser->can('Delete:Inspectionreport');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('DeleteAny:Inspectionreport');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:Inspectionreport');
    }
}
