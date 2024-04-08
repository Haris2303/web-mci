<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Background extends Model
{
    use HasFactory;

    protected $table = 'background';

    protected $fillable = ['content', 'user_id'];

    public function admin(): BelongsTo
    {
        return $this->belongsTo(Background::class, 'user_id', 'id');
    }
}
