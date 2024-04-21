<?php

namespace App\Policies;

use App\Models\LeadershipStructure;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class LeadershipStructurePolicy
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
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, LeadershipStructure $leadershipStructure): bool
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
