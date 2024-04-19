<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AboutUs;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AboutUsController extends Controller
{
    public function upsert(Request $request): RedirectResponse
    {
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

        return redirect()->to('/dashboard/about_us')->with('success', 'Data berhasil diubah');
    }
}
