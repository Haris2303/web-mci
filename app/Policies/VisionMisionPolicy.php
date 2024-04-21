<?php

namespace App\Policies;

use App\Models\User;
use App\Models\VisionMision;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Log;

class VisionMisionPolicy
{
    public function before(User $user, string $ability)
    {
        if ($user->roles[0]->name === 'admin') {
            return true;
        }
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, VisionMision $visionMision): bool
    {
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function create(User $user): bool
    {
        return false;
    }
}
