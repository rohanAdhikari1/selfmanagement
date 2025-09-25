<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\Task;
use Illuminate\Auth\Access\HandlesAuthorization;

class TaskPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:Task');
    }

    public function view(AuthUser $authUser, Task $task): bool
    {
        return $authUser->can('View:Task');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:Task');
    }

    public function update(AuthUser $authUser, Task $task): bool
    {
        return $authUser->can('Update:Task');
    }

    public function delete(AuthUser $authUser, Task $task): bool
    {
        return $authUser->can('Delete:Task');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('DeleteAny:Task');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:Task');
    }

}