<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AboutUs extends Model
{
    protected $table = 'about_us';

    protected $fillable = ['content', 'user_id'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(AboutUs::class, 'user_id', 'id');
    }
}
