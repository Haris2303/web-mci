<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BackgroundRequest;
use App\Models\Background;
use App\Services\BackgroundService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;

class BackgroundController extends Controller
{
    private BackgroundService $backgroundService;

    public function __construct(BackgroundService $backgroundService)
    {
        $this->backgroundService = $backgroundService;
    }

    public function create(): View
    {
        $background = Background::first();

        return view('admin.background.create', ['background' => $background]);
    }

    public function upsert(BackgroundRequest $request): RedirectResponse
    {
        // check permissions
        if (!Gate::allows('create', Background::class)) {
            abort(403);
        }

        // check validation
        $request->validated();

        DB::transaction(function () use ($request) {
            $this->backgroundService->upsert($request);
        });

        return redirect()->to('/background')->with('success', 'Data berhasil disimpan');
    }
}
