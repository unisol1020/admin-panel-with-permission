<?php


namespace App\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static \App\Services\RoleService update(int $id , ?array $dataForUpdate = null, ?array $permission = null)
 * @method static \App\Services\RoleService delete(int $id)
 * @method static \App\Services\RoleService get(int $id)
 *
 * @see \App\Services\RoleService
 */
class RoleService extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'RoleService';
    }
}
