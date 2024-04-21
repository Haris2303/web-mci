<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\DevisionRequest;
use App\Models\Devision;
use App\Services\DevisionService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;

class DevisionController extends Controller
{
    private DevisionService $devisionService;

    public function __construct(DevisionService $devisionService)
    {
        $this->devisionService = $devisionService;
    }

    public function store(DevisionRequest $request, Devision $devision): RedirectResponse
    {
        // check permission
        Gate::authorize('create', $devision);

        $data = $request->validated();

        DB::transaction(function () use ($data) {
            $devision = $this->devisionService->create($data);
            Log::info($devision);
        });

        return redirect()->to('/dashboard/devisions')->with('success', 'Data berhasil ditambahkan');
    }

    public function update(int $id, DevisionRequest $request): RedirectResponse
    {
        // get user by id
        $devision = Devision::where('id', $id)->firstOrFail();

        // check permission
        Gate::authorize('update', $devision);

        $data = $request->validated();

        DB::transaction(function () use ($id, $data) {
            $devision = $this->devisionService->update($id, $data);
            Log::info($devision);
        });

        return redirect()->to('/dashboard/devisions')->with('success', 'Data berhasil diubah');
    }

    public function destroy(int $id): RedirectResponse
    {
        // get user by id
        $devision = Devision::where('id', $id)->firstOrFail();

        // check permission
        Gate::authorize('delete', $devision);

        DB::transaction(function () use ($id) {
            $devision = $this->devisionService->delete($id);
            Log::info($devision);
        });

        return redirect()->to('/dashboard/devisions')->with('success', 'Data berhasil dihapus');
    }
}
