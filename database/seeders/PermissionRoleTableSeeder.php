<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;
use DB;

class PermissionRoleTableSeeder extends Seeder
{
    public function run()
    {
        $admin_permissions = Permission::all();
        Role::findOrFail(1)->permissions()->sync($admin_permissions->pluck('id'));

        $cashier_permissions = [
            [
                'role_id' => '2',
                'permission_id' => '2', 
            ],
            [
                'role_id' => '2',
                'permission_id' => '6', 
            ],
            [
                'role_id' => '2',
                'permission_id' => '8', 
            ],
            [
                'role_id' => '2',
                'permission_id' => '9', 
            ],
            [
                'role_id' => '2',
                'permission_id' => '13', 
            ],
            [
                'role_id' => '2',
                'permission_id' => '23', 
            ],
            [
                'role_id' => '2',
                'permission_id' => '24', 
            ],
            [
                'role_id' => '2',
                'permission_id' => '5', 
            ],
            [
                'role_id' => '2',
                'permission_id' => '10', 
            ],
            [
                'role_id' => '2',
                'permission_id' => '25', 
            ],
        ];

        DB::table('permission_role')->insert($cashier_permissions);


    }
}
