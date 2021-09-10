<?php

namespace App\Services;

use App\Enums\Entities;
use App\Enums\Methods;
use App\Models\Role;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class PermissionService extends BasicService
{
    /***********************************************************************************************************************
    For the rights we use binary system and it means that we take from a name of a route entity and an action method which we cause.
    For example:
    $routeName = 'reseller.show.hashes' that means that ['entity' =>'reseller' , 'action' => 'show'].
     ***********************************************************************************************************************/

    private $time = 0; //This variable is needed when we call a relation from relation and our scope did not work three times because we get a bug with empty instance into models
    private $canGetAllData = false;

    public function __construct()
    {
        if (Auth::check() && Auth::user()->isRoot()) {
            $this->canGetAllData = true;
        }
    }

    private function isPermitted(int $userPermissions , int $permissions): bool
    {
        return ($userPermissions & $permissions) === $permissions;
    }

    private function nextPermissions(int $permissions): int
    {
        return $permissions << count(Methods::all());
    }

    private function getPermissionsNumber(array $permissions): ?int
    {
        $permissionNumber = 0b00000;

        if (!empty($permissions['own'])) {
            foreach ($permissions['own'] as $personalPermission) {
                $permissionNumber = $permissionNumber | Methods::get($personalPermission);
            }
        }

        if (!empty($permissions['all'])) {
            foreach ($permissions['all'] as $allDataPermission) {
                $permissionNumber = $permissionNumber | Methods::get($allDataPermission) << count(Methods::all()) | Methods::get($allDataPermission);
            }
        }

        return $permissionNumber;
    }

    private function getParseRoute(): Collection
    {
        list($entity, $action) = explode('.',request()->route()->getName());

        return collect(['entity' => $entity , 'action' => $action]);
    }

    public function getGlobalScope(?string $entity = null, ?int $time = null)
    {
        $function = function (Builder $builder) {};

        if (!$this->canGetAllData && (empty($time) || $this->time < $time)) {
            if ($entity == 'user') {
                $function = function (Builder $builder) {
                    if (Auth::check()) {
                        $builder->where('id', Auth::user()->id);
                    }
                };
            } else {
                $function = function (Builder $builder) {
                    if (Auth::check()) {
                        $builder->whereHas('users', function ($query) {
                            $query->where('id', Auth::user()->id);
                        });
                    }
                };
            }
            $this->time++;
        }

        return $function;
    }

    public function check(): bool
    {
        if (Auth::user()->isRoot()) {
            return true;
        }

        $route = $this->getParseRoute();

        $userPermission = Auth::user()->getPermissions($route->get('entity'));
        $permission = Methods::get($route->get('action'));

        if (!$result = $this->isPermitted($userPermission , $permission)) return $result;

        $this->canGetAllData = $this->isPermitted($userPermission , $this->nextPermissions($permission));

        return $result;
    }

    public function createOrUpdate(Role $role , ?array $permissions): void
    {
        if (!empty($permissions)) {
            foreach ($permissions as $entity => $permission) {
                $permissionObj = $role->permissions()->where('entity' , $entity)->first();

                if (!empty($permissionObj)) {
                    $permissionObj->permission = $this->getPermissionsNumber($permission);
                    $permissionObj->save();
                } else {
                    $role->permissions()->create([
                        'entity'     => $entity,
                        'permission' => $this->getPermissionsNumber($permission)
                    ]);
                }
            }
        }
    }

    private function getCheckboxesArray(?int $permission): Collection
    {
        $data = collect(['all' => [] , 'own' => []]);
        $all = $own = [];

        if (!empty($permission)) {
            foreach (Methods::all() as $method => $value) {
                $active = $this->isPermitted($permission , $value);

                if ($active) {
                    $this->isPermitted($permission , $this->nextPermissions($value)) ? $all[] = $method : $own[] = $method;
                }

                $data->put('all' , $all);
                $data->put('own' , $own);
            }
        }

        return $data;
    }

    public function getPreparedPermissions($permissions): Collection
    {
        $data = collect();

        foreach (Entities::all() as $entity) {
            $rolePermission = $permissions->filter(function($value, $key) use ($entity) {
                if ($value['entity'] == $entity) {
                    return true;
                }
            })->first()->permissions ?? null;

            $data->put($entity, $this->getCheckboxesArray($rolePermission));
        }

        return $data;
    }
}
