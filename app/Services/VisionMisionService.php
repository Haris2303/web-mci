<?php

namespace App\Services;

use App\Http\Requests\Admin\VisionMisionRequest;

interface VisionMisionService
{
    function upsert(VisionMisionRequest $data): void;
}
