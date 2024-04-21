<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class VisionMision extends Model
{
    use HasFactory;

    /**
     * The attributes that are table name.
     *
     * @var string
     */
    protected $table = 'vision_misions';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['content', 'user_id'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(VisionMision::class, 'user_id', 'id');
    }
}
