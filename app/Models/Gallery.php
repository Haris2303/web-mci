<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Gallery extends Model
{
    protected $table = 'galleries';

    protected $fillable = ['image'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(Gallery::class, 'user_id', 'id');
    }
}
