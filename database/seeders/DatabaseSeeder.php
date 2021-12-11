<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            PermissionsTableSeeder::class,
            RolesTableSeeder::class,
            PermissionRoleTableSeeder::class,
            UserSeeder::class,
            RoleUserTableSeeder::class,
            // InventorySeeder::class,
            CategorySeeder::class,
            // PurchaseOrderSeeder::class,
            // PendingProductSeeder::class,
            SupplierSeeder::class,
            StatusReturnSeeder::class,
            SizeSeeder::class,
            OrderNumberSeeder::class,
            SalesSeeder::class,
            CustomerSeeder::class,
            LocationSeeder::class,
            PriceTypeSeeder::class,
            // OrderSalesSeeder::class,
            SalesInvoiceSeeder::class,
            UCSSeeder::class,
            ReceivingGoodSeeder::class,
            SalesInventorySeeder::class,
            EmptyBottlesInventorySeeder::class,
            ReceivingProductSeeder::class,
           
        ]);
    }
}
