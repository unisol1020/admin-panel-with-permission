<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $fillable = [
        'role_id',
        'name',
        'entity',
        'permission'
    ];

    protected $hidden = [
        'updated_at',
        'created_at',
    ];

    public function roles()
    {
        return $this->belongsTo(Role::class);
    }
}
