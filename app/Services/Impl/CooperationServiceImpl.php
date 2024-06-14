<?php

namespace App\Services\Impl;

use App\Models\Cooperation;
use App\Services\CooperationService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CooperationServiceImpl implements CooperationService
{
    public function create(array $data): Cooperation
    {
        $cooperation = new Cooperation();
        $cooperation->image = $data['image'];
        $cooperation->content = $data['content'];
        $cooperation->user_id = Auth::id();
        $cooperation->save();

        return $cooperation;
    }

    public function update(int $id, array $data): Cooperation
    {
        $cooperation = Cooperation::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        $cooperation->fill($data);
        $cooperation->save();

        return $cooperation;
    }

    public function delete(int $id): Cooperation
    {
        $cooperation = Cooperation::where('id', $id)->firstOrFail();
        Storage::delete($cooperation->image);
        $cooperation->delete();

        return $cooperation;
    }
}
