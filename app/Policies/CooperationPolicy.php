<?php

namespace App\Policies;

use App\Models\Cooperation;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class CooperationPolicy
{
    public function before(User $user, string $ability)
    {
        if ($user->roles[0]->name === 'superadmin') {
            return true;
        }
    }
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        foreach ($user->roles[0]->permissions as $permission) {
            if ($permission->name === 'viewAny-cooperation') {
                return true;
            }
        }
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Cooperation $cooperation): bool
    {
        if ($user->id === $cooperation->user_id) {
            foreach ($user->roles[0]->permissions as $permission) {
                if ($permission->name === 'view-cooperation') {
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
            if ($permission->name === 'create-cooperation') {
                return true;
            }
        }
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Cooperation $cooperation): bool
    {
        if ($user->id === $cooperation->user_id) {
            foreach ($user->roles[0]->permissions as $permission) {
                if ($permission->name === 'update-cooperation') {
                    return true;
                }
            }
        }
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Cooperation $cooperation): bool
    {
        if ($user->id === $cooperation->user_id) {
            foreach ($user->roles[0]->permissions as $permission) {
                if ($permission->name === 'delete-cooperation') {
                    return true;
                }
            }
        }
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Cooperation $cooperation): bool
    {
        if ($user->id === $cooperation->user_id) {
            foreach ($user->roles[0]->permissions as $permission) {
                if ($permission->name === 'restore-cooperation') {
                    return true;
                }
            }
        }
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Cooperation $cooperation): bool
    {
        if ($user->id === $cooperation->user_id) {
            foreach ($user->roles[0]->permissions as $permission) {
                if ($permission->name === 'forceDelete-cooperation') {
                    return true;
                }
            }
        }
        return false;
    }
}
