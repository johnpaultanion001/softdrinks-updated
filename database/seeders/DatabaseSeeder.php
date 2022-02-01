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
            CategorySeeder::class,
            SupplierSeeder::class,
            StatusReturnSeeder::class,
            SizeSeeder::class,
            OrderNumberSeeder::class,
            SalesSeeder::class,
            CustomerSeeder::class,
            LocationSeeder::class,
            PriceTypeSeeder::class,
            SalesInvoiceSeeder::class,
            UCSSeeder::class,
            ReceivingGoodSeeder::class,
            SalesInventorySeeder::class,
            EmptyBottlesInventorySeeder::class,
            ReceivingProductSeeder::class,
            PayableReceivingGoodSeeder::class,
            LocationProductSeeder::class,
            AssignDeliverSeeder::class,
            ReceiveReturnSeeder::class,
        ]);
    }
}
