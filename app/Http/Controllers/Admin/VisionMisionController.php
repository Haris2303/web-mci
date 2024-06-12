<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\VisionMisionRequest;
use App\Models\VisionMision;
use App\Services\VisionMisionService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class VisionMisionController extends Controller
{
    protected $visionMisionService;

    public function __construct(VisionMisionService $visionMisionService)
    {
        $this->visionMisionService = $visionMisionService;
    }

    public function create(): View
    {
        return view('admin.vision-mision.create', ['content' => VisionMision::first()->content ?? "Kosong"]);
    }

    public function upsert(VisionMisionRequest $request)
    {
        // check permissions
        Gate::authorize('create', VisionMision::class);

        $request->validated();

        DB::transaction(function () use ($request) {
            $this->visionMisionService->upsert($request);
        });

        return redirect()->to('/vision-mision')->with('success', 'Data berhasil disimpan');
    }
}
