<?php


namespace App\Services;

use App\Models\Role;
use App\Models\User;

class UserService extends BasicService
{
    public function assignRole(User $user , ?array $roleIds): void
    {
        if (!empty($roleIds)) {
            $roleIds = array_diff($roleIds , [1]); //Remove the admin role from the array if it is there

            $roles = Role::find($roleIds);

            if (!empty($roles)) {
                $user->roles()->detach();
                $user->roles()->attach($roles);
            }
        }
    }

    public function assignRoleById(int $id , ?array $roleIds): void
    {
        $user = User::findOrFail($id);

        $this->assignRole($user , $roleIds);
    }

    public function update(int $id , ?array $updateData , ?array $roleIds): array
    {
        $user = User::findOrFail($id);

        if (!$user->isRoot()) {
            if (!empty($updateData)) {
                $user->fill($updateData);
                $user->save();
            }

            $this->assignRole($user , $roleIds);
        } else {
            $this->setResponse('update' , 422 , 'Access denied for the update this user');
        }

        return $this->getResponse('update');
    }

    public function delete(int $id): array
    {
        $user = User::findOrFail($id);
        $test = User::first();
        if (!$user->isRoot()) {
            $user->delete();
        } else {

            $this->setResponse('delete' , 422 , 'Access denied for the delete this user');
        }

        return $this->getResponse('delete');
    }
}
