<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static \App\Services\UserService assignRole(Users $user , ?array $roleIds = null)
 * @method static \App\Services\UserService assignRoleById(int $id , ?array $roleIds = null)
 * @method static \App\Services\UserService update(int $id , ?array $updateData = null , ?array $roleIds = null)
 * @method static \App\Services\UserService delete(int $id)
 *
 * @see \App\Services\UserService
 */
class UserService extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'UserService';
    }
}
