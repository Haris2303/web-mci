<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LeadershipStructure;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class LeadershipStructureController extends Controller
{
    public function index(): View
    {
        $data = [
            'title' => 'Struktur UKM',
            'leadership_structure' => LeadershipStructure::first() ?? ''
        ];

        return view('admin.leadership-structure.index', $data);
    }

    public function upsert(Request $request): RedirectResponse
    {
        Gate::authorize('create', LeadershipStructure::class);

        $credentials = $request->validate([
            'image' => ['required', 'file', 'image', 'max:1024'],
            'description' => ['required', 'string']
        ]);

        if ($request->file('image')) {
            $credentials['image'] = $request->file('image')->store('leadership_structure');
        }

        $old_data = LeadershipStructure::first();

        DB::transaction(function () use ($credentials) {

            $leadership_structure = LeadershipStructure::query()->updateOrCreate([], [
                'image' => $credentials['image'],
                'description' => $credentials['description'],
                'user_id' => Auth::id()
            ]);
            $leadership_structure->save();
        });

        Storage::delete($old_data->image);

        return redirect()->to('/leadership-structure')->with('success', 'Data berhasil diubah');
    }
}
