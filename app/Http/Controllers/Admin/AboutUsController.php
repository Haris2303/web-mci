<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AboutUs;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;

class AboutUsController extends Controller
{
    public function index(): View
    {
        $data = [
            'title' => 'Tentang Kami',
            'about_us' => AboutUs::first()
        ];

        return view('admin.about-us.index', $data);
    }

    public function upsert(Request $request): RedirectResponse
    {
        // check permission
        Gate::authorize('create', AboutUs::class);

        $credentials = $request->validate([
            'content' => ['required', 'string']
        ]);

        DB::transaction(function () use ($credentials) {
            $aboutUs = AboutUs::updateOrCreate([], [
                'content' => $credentials['content'],
                'user_id' => Auth::id()
            ]);
            Log::info($aboutUs);
        });

        return redirect()->to('/about-us')->with('success', 'Data berhasil di simpan');
    }
}
