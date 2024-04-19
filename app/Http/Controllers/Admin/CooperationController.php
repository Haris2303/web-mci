<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CooperationRequest;
use App\Services\CooperationService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class CooperationController extends Controller
{
    private CooperationService $cooperationService;

    public function __construct(CooperationService $cooperationService)
    {
        $this->cooperationService = $cooperationService;
    }

    public function store(CooperationRequest $request): RedirectResponse
    {
        $credentials = $request->validated();

        if ($request->file('image')) {
            $credentials['image'] = $request->file('image')->store('cooperations');
        }

        DB::transaction(function () use ($credentials) {
            $cooperation = $this->cooperationService->create($credentials);
            Log::info($cooperation);
        });

        return redirect()->to('/dashboard/cooperations')->with('success', 'Data berhasil ditambahkan');
    }

    public function update(int $id, CooperationRequest $request): RedirectResponse
    {
        $credentials = $request->validated();

        if ($request->file('image')) {
            // if image is change
            if ($request->oldImage) {
                Storage::delete($request->oldImage);
            }
            $credentials['image'] = $request->file('image')->store('cooperations');
        }

        DB::transaction(function () use ($id, $credentials) {
            $cooperation = $this->cooperationService->update($id, $credentials);
            Log::info($cooperation);
        });

        return redirect()->to('/dashboard/cooperations')->with('success', 'Data berhasil diubah');
    }

    public function destroy(int $id): RedirectResponse
    {
        DB::transaction(function () use ($id) {
            $cooperation = $this->cooperationService->delete($id);
            Log::info($cooperation);
        });

        return redirect()->to('/dashboard/cooperations')->with('success', 'Data berhasil dihapus');
    }
}
