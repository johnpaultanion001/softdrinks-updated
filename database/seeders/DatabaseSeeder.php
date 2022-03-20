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

            //Sales Invoice
            // SalesInvoiceSeeder::class,
            // SalesSeeder::class,
           

            // Receiving Goods
            UCSSeeder::class,
            ReceivingGoodSeeder::class,
            SalesInventorySeeder::class,
            ReceivingProductSeeder::class,
            LocationProductSeeder::class,

            //Return
            EmptyBottlesInventorySeeder::class,
            ReceiveReturnSeeder::class,
            // SalesReturnSeeder::class,


            CustomerSeeder::class,
            LocationSeeder::class,
            PriceTypeSeeder::class,
            
            
            AssignDeliverSeeder::class,
            
            
        ]);
    }
}
