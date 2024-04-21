<?php

namespace App\Policies;

use App\Models\Background;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class BackgroundPolicy
{
    /**
     * Determine the user can all access the model.
     */
    public function before(User $user, string $ability)
    {
        if ($user->roles[0]->name === 'admin') {
            return true;
        }
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Background $background): bool
    {
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Background $background): bool
    {
        return false;
    }
}
