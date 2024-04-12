<?php

namespace App\Services\Impl;

use App\Http\Requests\Admin\VisionMisionRequest;
use App\Models\VisionMision;
use App\Services\VisionMisionService;
use Illuminate\Support\Facades\Auth;

class VisionMisionServiceImpl implements VisionMisionService
{
    public function change(VisionMisionRequest $data): void
    {
        $visionMision = VisionMision::updateOrCreate([], [
            'content' => $data['content'],
            'user_id' => Auth::id()
        ]);
        $visionMision->save();
    }
}
