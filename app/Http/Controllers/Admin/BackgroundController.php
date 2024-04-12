<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BackgroundRequest;
use App\Models\Background;
use App\Services\BackgroundService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

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

        $this->backgroundService->change($request);

        return redirect()->to('/dashboard/background')->with('success', 'Data berhasil');
    }
}
