<?php

namespace App\Services;

use App\Http\Requests\Admin\BackgroundRequest;

interface BackgroundService
{
    function upsert(BackgroundRequest $request): void;
}
