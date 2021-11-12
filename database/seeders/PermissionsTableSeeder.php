<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'id'    => '1',
                'title' => 'user_management_access',
            ],
            
            [
                'id'    => '2',
                'title' => 'permission_access',
            ],
            [
                'id'    => '3',
                'title' => 'role_access',
            ],
            [
                'id'    => '4',
                'title' => 'user_access',
            ],
            [
                'id'    => '5',
                'title' => 'dashboard_access',
            ],
            [
                'id'    => '6',
                'title' => 'inventories_access',
            ],
            [
                'id'    => '7',
                'title' => 'salesinvoice_access',
            ],
            [
                'id'    => '8',
                'title' => 'sales_report_access',
            ],
            [
                'id'    => '9',
                'title' => 'report_access',
            ],
            [
                'id'    => '10',
                'title' => 'graph_access',
            ],
            [
                'id'    => '11',
                'title' => 'purchase_order_access',
            ],
            [
                'id'    => '12',
                'title' => 'supplier_access',
            ],
            [
                'id'    => '13',
                'title' => 'returned_access',
            ],
            [
                'id'    => '14',
                'title' => 'status-return_access',
            ],
            [
                'id'    => '15',
                'title' => 'sizes_access',
            ],
            [
                'id'    => '16',
                'title' => 'ucs_access',
            ],
            [
                'id'    => '17',
                'title' => 'category_access',
            ],
            [
                'id'    => '18',
                'title' => 'setting_access',
            ],
            [
                'id'    => '19',
                'title' => 'customers_access',
            ],
            [
                'id'    => '20',
                'title' => 'locations_access',
            ],
            [
                'id'    => '21',
                'title' => 'location_transfer_access',
            ],
            [
                'id'    => '22',
                'title' => 'price_type_access',
            ],
            [
                'id'    => '23',
                'title' => 'empty_bottles_inventory',
            ],
            

            

            
            
        ];

        Permission::insert($permissions);

    }
}
