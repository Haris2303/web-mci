<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\VisionMisionRequest;
use App\Services\VisionMisionService;
use Illuminate\Http\Request;

class VisionMisionController extends Controller
{
    protected $visionMisionService;

    public function __construct(VisionMisionService $visionMisionService)
    {
        $this->visionMisionService = $visionMisionService;
    }

    public function update(VisionMisionRequest $request)
    {
        $request->validated();

        $this->visionMisionService->change($request);

        return redirect()->to('/dashboard/visionmision')->with('success', 'Data berhasil diubah');
    }
}
