<?php

namespace App\Policies;

use App\Models\AboutUs;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class AboutUsPolicy
{
    public function before(User $user, string $ability)
    {
        if ($user->roles[0]->name === 'admin' || $user->roles[0]->name = 'superadmin') {
            return true;
        }
    }

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return false;
    }
}
