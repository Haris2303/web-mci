<?php

namespace App\Policies;

use App\Models\Project;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ProjectPolicy
{

    public function before(User $user, string $ability)
    {
        if ($user->roles[0]->name === 'admin') {
            return true;
        }
    }

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        foreach ($user->roles[0]->permissions as $permission) {
            if ($permission->name === 'viewAny-project') {
                return true;
            }
        }
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Project $project): bool
    {
        if ($user->id === $project->user_id) {
            foreach ($user->roles[0]->permissions as $permission) {
                if ($permission->name === 'view-project') {
                    return true;
                }
            }
        }
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        foreach ($user->roles[0]->permissions as $permission) {
            if ($permission->name === 'create-project') {
                return true;
            }
        }
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Project $project): bool
    {
        if ($user->id === $project->user_id) {
            foreach ($user->roles[0]->permissions as $permission) {
                if ($permission->name === 'update-project') {
                    return true;
                }
            }
        }
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Project $project): bool
    {
        if ($user->id === $project->user_id) {
            foreach ($user->roles[0]->permissions as $permission) {
                if ($permission->name === 'delete-project') {
                    return true;
                }
            }
        }
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Project $project): bool
    {
        if ($user->id === $project->user_id) {
            foreach ($user->roles[0]->permissions as $permission) {
                if ($permission->name === 'restore-project') {
                    return true;
                }
            }
        }
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Project $project): bool
    {
        if ($user->id === $project->user_id) {
            foreach ($user->roles[0]->permissions as $permission) {
                if ($permission->name === 'forceDelete-project') {
                    return true;
                }
            }
        }
        return false;
    }
}
