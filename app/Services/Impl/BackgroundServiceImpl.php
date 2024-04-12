<?php

namespace App\Services\Impl;

use App\Http\Requests\Admin\BackgroundRequest;
use App\Models\Background;
use App\Services\BackgroundService;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Auth;

class BackgroundServiceImpl implements BackgroundService
{
    public function change(BackgroundRequest $request): void
    {
        $background = Background::updateOrCreate([], [
            'content' => $request['content'],
            'user_id' => Auth::id()
        ]);
        $background->save();
    }
}
