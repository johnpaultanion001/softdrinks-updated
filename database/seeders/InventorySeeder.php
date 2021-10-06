<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Inventory;


class InventorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        date_default_timezone_set('Asia/Manila');
        $invs = [
            [
                'id'    => '1',
                'category_id'    => '1',
                'purchase_order_number_id' => '1',
                
                'product_code' => 'CXL',
                'long_description' => 'Coke 1.5 L',
                'short_description' => 'Coke 1.5 L',

                'stock' => '200',
                'qty' => '200',
                'pqty' => '200',
                'sold' => '0',

                'size_id' => '3',
                'expiration' => '2022-08-24',
                'purchase_amount' => '400',
                'profit' => '50',
                'price' => '450',
                'total_amount_purchase' => '79200',
                'total_profit' => '9900',
                'total_price' => '89100',
                'product_remarks' => 'sample',
                'isRemove' => '0',
                'location_id' => 2,
                'product_id' => '1221121',
                
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),

                'supplier_id' => '1',
                'ucs_size' => 3.10,
            ],
            [
                'id'    => '2',
                'category_id'    => '3',
                'purchase_order_number_id' => '1',

                'product_code' => 'SXL',
                'long_description' => 'Sprite 1.5 L',
                'short_description' => 'Sprite 1.5 L',

                'stock' => '200',
                'qty' => '200',
                'pqty' => '200',
                'sold' => '0',


                'size_id' => '3',
                'expiration' => '2022-08-24',

                'purchase_amount' => '20',
                'profit' => '5',
                'price' => '25',
                'location_id' => 2,
                'total_amount_purchase' => '4000',
                'total_profit' => '1000',
                'total_price' => '5000',

                'product_remarks' => 'sample',
                'isRemove' => '0',
                'product_id' => '1221122',
                
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
                'supplier_id' => '1',
                'ucs_size' => 3.10,
            ],


            [
                'id'    => '3',
                'category_id'    => '1',
                'purchase_order_number_id' => '1',

                'product_code' => 'MDXL',
                'long_description' => 'MOUNTAIN DEW 1.5 L',
                'short_description' => 'MOUNTAIN DEW 1.5 L',

                'stock' => '20',
                'qty' => '20',
                'pqty' => '20',
                'sold' => '0',

                'size_id' => '2',
                
                'expiration' => '2022-08-24',
                'location_id' => 2,
                'purchase_amount' => '500',
                'profit' => '100',
                'price' => '600',

                'total_amount_purchase' => '10000',
                'total_profit' => '2000',
                'total_price' => '12000',

                'product_remarks' => 'sample',
                'isRemove' => '0',
                'product_id' => '1221123',
                
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
                'supplier_id' => '1',
                'ucs_size' => 1.50,
            ],

            [
                'id'    => '4',
                'category_id'    => '1',
                'purchase_order_number_id' => '1',

                'product_code' => 'RCXL',
                'long_description' => 'RC 1.5 L',
                'short_description' => 'RC 1.5 L',

                'stock' => '20',
                'qty' => '20',
                'pqty' => '20',
                'sold' => '0',

                'size_id' => '2',
                
                'expiration' => '2022-08-24',
                'location_id' => 1,
                'purchase_amount' => '500',
                'profit' => '100',
                'price' => '600',

                'total_amount_purchase' => '10000',
                'total_profit' => '2000',
                'total_price' => '12000',

                'product_remarks' => 'sample',
                'isRemove' => '0',
                'product_id' => '1221124',
                
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
                'supplier_id' => '1',
                'ucs_size' => 1.50,
            ],

            [
                'id'    => '5',
                'category_id'    => '1',
                'purchase_order_number_id' => '1',

                'product_code' => 'PXL',
                'long_description' => 'PEPSI 1.5 L',
                'short_description' => 'PEPSI 1.5 L',

                'stock' => '20',
                'qty' => '20',
                'pqty' => '20',
                'sold' => '0',

                'size_id' => '2',
                
                'expiration' => '2022-08-24',
                'location_id' => 1,
                'purchase_amount' => '500',
                'profit' => '100',
                'price' => '600',

                'total_amount_purchase' => '10000',
                'total_profit' => '2000',
                'total_price' => '12000',

                'product_remarks' => 'sample',
                'isRemove' => '0',
                'product_id' => '1221126',
                
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
                'supplier_id' => '1',
                'ucs_size' => 1.50,
            ],
           
        ];

        Inventory::insert($invs);

    }
}
