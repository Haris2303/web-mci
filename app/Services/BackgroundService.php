<?php

namespace App\Services;

use Illuminate\Contracts\Auth\Authenticatable;

interface BackgroundService
{
    function change(int $user_id, string $content): void;
}
