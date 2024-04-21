<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\VisionMisionRequest;
use App\Models\VisionMision;
use App\Services\VisionMisionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class VisionMisionController extends Controller
{
    protected $visionMisionService;

    public function __construct(VisionMisionService $visionMisionService)
    {
        $this->visionMisionService = $visionMisionService;
    }

    public function update(VisionMisionRequest $request, VisionMision $visionMision)
    {
        // check permissions
        Gate::authorize('update', $visionMision);

        $request->validated();

        $this->visionMisionService->upsert($request);

        return redirect()->to('/dashboard/vision-mision')->with('success', 'Data berhasil diubah');
    }
}
