<?php

namespace App\Services;

use App\Http\Requests\Admin\BackgroundRequest;

interface BackgroundService
{
    function change(BackgroundRequest $request): void;
}
