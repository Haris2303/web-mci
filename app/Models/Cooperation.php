<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Cooperation extends Model
{
    protected $table = 'cooperations';

    protected $fillable = ['image', 'content'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(Cooperation::class, 'user_id', 'id');
    }
}
