<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $user = User::query()->whereHas('roles', function ($query) {
            $query->where('name', '!=', 'admin');
        })->get();

        $data = [
            'title' => 'Users',
            'users' => $user
        ];

        return view('admin.user.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $data = [
            'title' => 'Add User',
            'roles' => Role::all()
        ];

        return view('admin.user.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => $request->cookie('X-TOKEN')
        ])->post('http://localhost:8000/api/users', $request);

        if ($response->badRequest()) {
            $response = json_decode($response);
            return redirect()->to('/users/create')->withErrors([
                'name' => $response->errors->name ?? '',
                'email' => $response->errors->email ?? '',
                'password' => $response->errors->password ?? '',
                'role_id' => $response->errors->role_id ?? '',
            ]);
        }

        if ($response->status() === 201) {
            return redirect()->to('/users')->with('success', 'Data user berhasil terdaftar!');
        }

        abort(401);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => Cookie::get('X-TOKEN')
        ])->delete('http://localhost:8000/api/users/' . $user->id);

        if ($response->ok()) {
            return redirect()->to('/users')->with('success', 'Data user berhasil dihapus!');
        }

        abort(401);
    }
}
