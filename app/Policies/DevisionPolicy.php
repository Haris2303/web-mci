<?php

namespace App\Policies;

use App\Models\Devision;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Log;

class DevisionPolicy
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
            if ($permission->name === 'viewAny-devision') {
                return true;
            }
        }
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Devision $devision): bool
    {
        if ($user->id === $devision->user_id) {
            foreach ($user->roles[0]->permissions as $permission) {
                if ($permission->name === 'view-devision') {
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
            if ($permission->name === 'create-devision') {
                return true;
            }
        }
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Devision $devision): bool
    {
        if ($user->id === $devision->user_id) {
            foreach ($user->roles[0]->permissions as $permission) {
                if ($permission->name === 'update-devision') {
                    return true;
                }
            }
        }

        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Devision $devision): bool
    {
        if ($user->id === $devision->user_id) {
            foreach ($user->roles[0]->permissions as $permission) {
                if ($permission->name === 'delete-devision') {
                    return true;
                }
            }
        }
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Devision $devision): bool
    {
        if ($user->id === $devision->user_id) {
            foreach ($user->roles[0]->permissions as $permission) {
                if ($permission->name === 'restore-devision') {
                    return true;
                }
            }
        }
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Devision $devision): bool
    {
        if ($user->id === $devision->user_id) {
            foreach ($user->roles[0]->permissions as $permission) {
                if ($permission->name === 'forceDelete-devision') {
                    return true;
                }
            }
        }
        return false;
    }
}
