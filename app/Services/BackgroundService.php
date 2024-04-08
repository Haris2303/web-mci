<?php

namespace App\Services;

use Illuminate\Contracts\Auth\Authenticatable;

interface BackgroundService
{
    function save(int $user_id, string $content): void;
}
