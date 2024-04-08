<?php

namespace App\Services\Impl;

use App\Models\Background;
use App\Services\BackgroundService;
use Illuminate\Contracts\Auth\Authenticatable;

class BackgroundServiceImpl implements BackgroundService
{
    public function save(int $user_id, string $content): void
    {
        $background = new Background([
            'content' => $content,
            'user_id' => $user_id,
        ]);
        $background->save();
    }
}
