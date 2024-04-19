<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Devision extends Model
{
    protected $table = 'devisions';
    protected $fillable = ['name', 'content'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(Devision::class, 'user_id', 'id');
    }
}
