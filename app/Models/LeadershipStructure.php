<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LeadershipStructure extends Model
{
    protected $table = 'leadership_structures';

    protected $fillable = ['image', 'description', 'user_id'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(LeadershipStructure::class, 'user_id', 'id');
    }
}
