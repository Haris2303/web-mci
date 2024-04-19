<?php

namespace App\Services\Impl;

use App\Models\Devision;
use App\Services\DevisionService;
use Illuminate\Support\Facades\Auth;

class DevisionServiceImpl implements DevisionService
{
    public function create(array $data): Devision
    {
        $devision = new Devision();
        $devision->name = $data['name'];
        $devision->content = $data['content'];
        $devision->user_id = Auth::id();
        $devision->save();

        return $devision;
    }

    public function update(int $id, array $data): Devision
    {
        $devision = Devision::where('id', $id)->where('user_id', Auth::id())->firstOrFail();

        $devision->name = $data['name'];
        $devision->content = $data['content'];
        $devision->user_id = Auth::id();
        $devision->save();

        return $devision;
    }

    public function delete(int $id): Devision
    {
        $devision = Devision::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        $devision->delete();

        return $devision;
    }
}
