<?php

namespace App\Services;

use App\Facades\PermissionService;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Support\Collection;

class RoleService extends BasicService
{
    public function get(int $id): Collection
    {
        $role = Role::with('permissions')->findOrFail($id);

        $data = collect([
            'id'          => $role->id,
            'name'        => $role->name,
            'permissions' => $role->root ? [] : PermissionService::getPreparedPermissions($role->permissions)
        ]);

        return $data;
    }

    public function update(int $id , ?array $dataForUpdate, ?array $permission): array
    {
        $role = Role::findOrFail($id);

        if (!$role->system) {
            if (!empty($dataForUpdate)) {
                $role->fill($dataForUpdate);
                $role->save();
            }

            PermissionService::createOrUpdate($role , $permission);
        } else {
            $this->setResponse('update' , 422 , 'Access denied for updating system role');
        }

        return $this->getResponse('update');
    }

    public function delete(int $id): array
    {
        $role = Role::findOrFail($id);

        if (!$role->system) {
            Permission::where('role_id' , $role->id)->delete();
            $role->delete();
        } else {
            $this->setResponse('delete' , 422 , 'Access denied for deleting system role');
        }

        return $this->getResponse('delete');
    }
}
