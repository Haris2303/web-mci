<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'is_active',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Establishes a many-to-many relationship between User and Role models.
     * This relationship is facilitated through the 'user_roles' pivot table, linking 'user_id' and 'role_id'.
     */
    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class, "user_roles", "user_id", "role_id");
    }

    /**
     * Defines a one-to-one relationship between User and Background models.
     * background just has one column, identified by 'user_id' in the Background model.
     */
    public function background(): HasOne
    {
        return $this->hasOne(Background::class, 'user_id', 'id');
    }

    /**
     * Defines a one-to-one relationship between User and VisionMision models.
     * vision and mission just has one column, identified by 'user_id' in the VisionMision model.
     */
    public function visionMision(): HasOne
    {
        return $this->hasOne(VisionMision::class, 'user_id', 'id');
    }

    /**
     * Defines a one-to-many relationship between User and Project models.
     * Projects has many column, identified by 'user_id' in the Project model.
     */
    public function projects(): HasMany
    {
        return $this->hasMany(Project::class, 'user_id', 'id');
    }
}
