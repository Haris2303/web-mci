<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Role extends Model
{
    // The name of the table associated with the model in the database.
    protected $table = 'roles';

    // List of attributes that can be mass assigned.
    protected $fillable = ['name', 'description'];

    /**
     * Defines the many-to-many relationship between Role and User.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany The relationship between the Role model and User.
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, "user_roles", "role_id", "user_id");
    }

    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(Permission::class, 'role_permissions', 'role_id', 'permission_id');
    }
}
