<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CooperationRequest;
use App\Http\Requests\Admin\CooperationUpdateRequest;
use App\Models\Cooperation;
use App\Services\CooperationService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class CooperationController extends Controller
{
    private CooperationService $cooperationService;

    public function __construct(CooperationService $cooperationService)
    {
        $this->cooperationService = $cooperationService;
    }

    public function index(): View
    {
        $data = [
            'title' => 'Kerja Sama',
            'cooperations' => Cooperation::all()
        ];

        return view('admin.cooperation.index', $data);
    }

    public function create(): View
    {
        $data = [
            'title' => 'Create Kerja Sama'
        ];

        return view('admin.cooperation.create', $data);
    }

    public function store(CooperationRequest $request): RedirectResponse
    {
        // check permission
        Gate::authorize('create', Cooperation::class);

        $credentials = $request->validated();

        if ($request->file('image')) {
            $credentials['image'] = $request->file('image')->store('cooperations');
        }

        DB::transaction(function () use ($credentials) {
            $cooperation = $this->cooperationService->create($credentials);
            Log::info($cooperation);
        });

        return redirect()->to('/cooperations')->with('success', 'Data berhasil ditambahkan');
    }

    public function edit(int $id): View
    {
        $data = [
            'title' => 'Edit Kerja Sama',
            'cooperation' => Cooperation::where('id', $id)->firstOrFail()
        ];

        return view('admin.cooperation.edit', $data);
    }

    public function update(int $id, CooperationUpdateRequest $request): RedirectResponse
    {
        // check permission
        $coopeartion = Cooperation::where('id', $id)->firstOrFail();
        Gate::authorize('update', $coopeartion);

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

        return redirect()->to('/cooperations')->with('success', 'Data berhasil diubah');
    }

    public function destroy(int $id): RedirectResponse
    {
        // check permission
        $coopeartion = Cooperation::where('id', $id)->firstOrFail();
        Gate::authorize('delete', $coopeartion);

        DB::transaction(function () use ($id) {
            $cooperation = $this->cooperationService->delete($id);
            Log::info($cooperation);
        });

        return redirect()->to('/cooperations')->with('success', 'Data berhasil dihapus');
    }
}
