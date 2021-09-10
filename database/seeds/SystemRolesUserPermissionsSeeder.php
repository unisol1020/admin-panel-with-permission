<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class SystemRolesUserPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            0 => [
                'id'     => 1,
                'name'   => 'Admin',
                'root'   => true,
                'system' => true
            ],
            1 => [
                'id'     => 2,
                'name'   => 'Reseller',
                'root'   => false,
                'system' => true
            ],
        ]);

        DB::table('users')->insert([
            'id'   => 1,
            'first_name' => 'Admin',
            'last_name'  => 'Admin',
            'email'      => 'admin@admin.admin',
            'password'   => Hash::make('admin'),
        ]);

        DB::table('role_user')->insert([
            'user_id' => 1,
            'role_id' => 1
        ]);

        DB::table('permissions')->insert([
            0 => [
                'id'            => 1,
                'role_id'       => 2,
                'entity'        => 'reseller',
                'permissions'   => 31,
            ],
            1 => [
                'id'            => 2,
                'role_id'       => 2,
                'entity'        => 'user',
                'permissions'   => 31,
            ],
            2 => [
                'id'            => 3,
                'role_id'       => 2,
                'entity'        => 'reseller_hash',
                'permissions'   => 31,
            ]
        ]);
    }
}
