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
                'title' => 'manager_dashboard_access',
            ],
            [
                'title' => 'receiving_goods_access',
            ],
            [
                'title' => 'void_receiving_goods',
            ],
            [
                'title' => 'update_receiving_goods',
            ],
            [
                'title' => 'account_payables',
            ],
            [
                'title' => 'sales_inventory_access',
            ],
            [
                'title' => 'update_sales_inventory',
            ],
            [
                'title' => 'empty_bottles_inventory_access',
            ],
            [
                'title' => 'sales_invoice_access',
            ],
            [
                'title' => 'account_receivable',
            ],
            [
                'title' => 'void_sales_invoice',
            ],
            [
                'title' => 'update_sales_invoice',
            ],
            [
                'title' => 'location_transfer_access',
            ],
            //SETTINGS
            [
                'title' => 'setting_section',
            ],
            [
                'title' => 'customers_access',
            ],
            [
                'title' => 'supplier_access',
            ],
            [
                'title' => 'price_type_access',
            ],
            [
                'title' => 'sizes_access',
            ],
            [
                'title' => 'category_access',
            ],
            [
                'title' => 'locations_access',
            ],
            [
                'title' => 'status_return_access',
            ],
            [
                'title' => 'assign_deliver_access',
            ],
            
            //REPORT
            [
                'title' => 'report_section',
            ],
            
            [
                'title' => 'transaction_access',
            ],
            [
                'title' => 'ucs_access',
            ],
            [
                
                'title' => 'graph_access',
            ],

            //USER MANAGEMENT
            [
                'title' => 'user_management_section',
            ],
            [
                'title' => 'role_access',
            ],
            [
                'title' => 'user_access',
            ],
        ];

        Permission::insert($permissions);

    }
}
