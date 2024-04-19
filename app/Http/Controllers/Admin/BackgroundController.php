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
        return view('admin.background.create');
    }

    public function update(BackgroundRequest $request): RedirectResponse
    {
        $request->validated();

        DB::transaction(function () use ($request) {
            $this->backgroundService->upsert($request);
        });

        return redirect()->to('/dashboard/background')->with('success', 'Data berhasil');
    }
}
