<?php

namespace App\Models;

use App\Traits\PermissionScopeTrait;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use PermissionScopeTrait;

    protected $fillable = [
        'name'
    ];

    protected $hidden = [
        'system',
        'root',
        'updated_at',
        'created_at',
    ];

    public function users()
    {
        return $this->belongsToMany(Auth::class , 'role_user' , 'role_id' , 'user_id');
    }

    public function permissions()
    {
        return $this->hasMany(Permission::class);
    }
}
