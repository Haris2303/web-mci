<?php

namespace App\Policies;

use App\Models\Gallery;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class GalleryPolicy
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
            if ($permission->name === 'viewAny-gallery') {
                return true;
            }
        }
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Gallery $gallery): bool
    {
        if ($user->id === $gallery->user_id) {
            foreach ($user->roles[0]->permissions as $permission) {
                if ($permission->name === 'view-gallery') {
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
            if ($permission->name === 'create-gallery') {
                return true;
            }
        }
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Gallery $gallery): bool
    {
        if ($user->id === $gallery->user_id) {
            foreach ($user->roles[0]->permissions as $permission) {
                if ($permission->name === 'delete-gallery') {
                    return true;
                }
            }
        }
        return false;
    }
}
