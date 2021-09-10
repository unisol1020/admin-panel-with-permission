<?php

namespace App\Traits;

use App\Models\Role;

trait UserModelTrait
{
    public function roles()
    {
        return $this->BelongsToMany(Role::class , 'role_user' , 'user_id');
    }

    public function permissions()
    {
        return $this->roles()->permissions;
    }

    public function isRoot(): bool
    {
        return (bool) $this->roles()->where('root' , true)->first();
    }

    public function getPermissions(string $entity): int
    {
        $permission = $this->roles->map(function ($role) use ($entity) {
            return $role->permissions()->where('entity' , $entity)->first()->permissions ?? 0;
        })->first();

        return $permission;
    }
}
