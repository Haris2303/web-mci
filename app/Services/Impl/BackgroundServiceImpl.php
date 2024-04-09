<?php

namespace App\Services\Impl;

use App\Models\Background;
use App\Services\BackgroundService;
use Illuminate\Contracts\Auth\Authenticatable;

class BackgroundServiceImpl implements BackgroundService
{
    public function change(int $user_id, string $content): void
    {
        $background = Background::firstOrNew([], [
            'content' => $content,
            'user_id' => $user_id
        ]);
        // $background->content = $content;
        // $background->user_id = $user_id;
        $background->save();
    }
}
