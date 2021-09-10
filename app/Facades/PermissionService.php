<?php

namespace App\Facades;

use App\Models\Role;
use Illuminate\Support\Facades\Facade;

/**
 * @method static \App\Services\PermissionService check()
 * @method static \App\Services\PermissionService createOrUpdate(Role $roleId , ?array $permissions)
 * @method static \App\Services\PermissionService getGlobalScope(?string $entity = null , ?int $time = null)
 * @method static \App\Services\PermissionService getPreparedPermissions($permissions)
 *
 * @see \App\Services\PermissionService
 */
class PermissionService extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'PermissionService';
    }
}
