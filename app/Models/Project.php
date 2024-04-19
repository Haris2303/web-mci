<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Project extends Model
{
    /**
     * The attributes that table name.
     *
     * @var string
     */
    protected $tablel = 'projects';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['slug', 'image', 'title', 'description', 'type'];


    public function user(): BelongsTo
    {
        return $this->belongsTo(Project::class, 'user_id', 'id');
    }
}
