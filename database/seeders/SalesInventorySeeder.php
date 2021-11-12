<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SalesInventory;

class SalesInventorySeeder extends Seeder
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
                'receiving_good_id' => '1',

                'product_code' => 'Coke Swakto',
                'category_id'    => '1',
                'description' => 'C200',

                'stock' => '50',
                'qty' => '50',
                'size_id' => '1',
                'expiration' => '2022-08-24',
                
                'unit_cost'  => '94',
                'regular_discount'  => '6',
                'hauling_discount'  => '0.9',
                'price'  => '100.9',
                'total_cost'    =>  '4355',
                
                'isRemove'      => false,
                'isComplete'      => true,

                'supplier_id' => '1',

                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
            [
                'receiving_good_id' => '1',

                'product_code' => 'Sprite Swakto',
                'category_id'    => '1',
                'description' => 'S200',

                'stock' => '50',
                'qty' => '50',
                'size_id' => '1',
                'expiration' => '2022-08-24',
                
                'unit_cost'  => '94',
                'regular_discount'  => '6',
                'hauling_discount'  => '0.9',
                'price'  => '100.9',
                'total_cost'    =>  '4355',
                
                'isRemove'      => false,
                'isComplete'      => true,

                'supplier_id' => '1',

                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
            [
                'receiving_good_id' => '1',

                'product_code' => 'Royal Swakto',
                'category_id'    => '1',
                'description' => 'R200',

                'stock' => '50',
                'qty' => '50',
                'size_id' => '1',
                'expiration' => '2022-08-24',
                
                'unit_cost'  => '94',
                'regular_discount'  => '6',
                'hauling_discount'  => '0.9',
                'price'  => '100.9',
                'total_cost'    =>  '4355',
                
                'isRemove'      => false,
                'isComplete'      => true,

                'supplier_id' => '1',

                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
            [
                'receiving_good_id' => '1',

                'product_code' => 'Coke Zero Swakto',
                'category_id'    => '1',
                'description' => 'CZ200',

                'stock' => '50',
                'qty' => '50',
                'size_id' => '1',
                'expiration' => '2022-08-24',
                
                'unit_cost'  => '94',
                'regular_discount'  => '6',
                'hauling_discount'  => '0.9',
                'price'  => '100.9',
                'total_cost'    =>  '4355',
                
                'isRemove'      => false,
                'isComplete'      => true,

                'supplier_id' => '1',

                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],

            [
                'receiving_good_id' => '1',

                'product_code' => 'Sarsi Swakto',
                'category_id'    => '1',
                'description' => 'SAR195',

                'stock' => '50',
                'qty' => '50',
                'size_id' => '2',
                'expiration' => '2022-08-24',
                
                'unit_cost'  => '94',
                'regular_discount'  => '6',
                'hauling_discount'  => '0.9',
                'price'  => '100.9',
                'total_cost'    =>  '4355',
                
                'isRemove'      => false,
                'isComplete'      => true,

                'supplier_id' => '1',

                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],

            [
                'receiving_good_id' => '1',

                'product_code' => 'Coke Mismo',
                'category_id'    => '1',
                'description' => 'CM',

                'stock' => '50',
                'qty' => '50',
                'size_id' => '3',
                'expiration' => '2022-08-24',
                
                'unit_cost'  => '127',
                'regular_discount'  => '6',
                'hauling_discount'  => '1.1',
                'price'  => '134.1',
                'total_cost'    =>  '5995',
                
                'isRemove'      => false,
                'isComplete'      => true,

                'supplier_id' => '1',

                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
            [
                'receiving_good_id' => '1',

                'product_code' => 'Sprite Mismo',
                'category_id'    => '1',
                'description' => 'SM',

                'stock' => '50',
                'qty' => '50',
                'size_id' => '3',
                'expiration' => '2022-08-24',
                
                'unit_cost'  => '127',
                'regular_discount'  => '6',
                'hauling_discount'  => '1.1',
                'price'  => '134.1',
                'total_cost'    =>  '5995',
                
                'isRemove'      => false,
                'isComplete'      => true,

                'supplier_id' => '1',

                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
            [
                'receiving_good_id' => '1',

                'product_code' => 'Royal Mismo',
                'category_id'    => '1',
                'description' => 'RM',

                'stock' => '50',
                'qty' => '50',
                'size_id' => '4',
                'expiration' => '2022-08-24',
                
                'unit_cost'  => '127',
                'regular_discount'  => '6',
                'hauling_discount'  => '1.1',
                'price'  => '134.1',
                'total_cost'    =>  '5995',
                
                'isRemove'      => false,
                'isComplete'      => true,

                'supplier_id' => '1',

                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
            [
                'receiving_good_id' => '1',

                'product_code' => 'Royal Lemon Mismo',
                'category_id'    => '1',
                'description' => 'RTL M',

                'stock' => '50',
                'qty' => '50',
                'size_id' => '4',
                'expiration' => '2022-08-24',
                
                'unit_cost'  => '127',
                'regular_discount'  => '6',
                'hauling_discount'  => '1.1',
                'price'  => '134.1',
                'total_cost'    =>  '5995',
                
                'isRemove'      => false,
                'isComplete'      => true,

                'supplier_id' => '1',

                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],

            [
                'receiving_good_id' => '1',

                'product_code' => 'Coke 8oz',
                'category_id'    => '1',
                'description' => 'C8',

                'stock' => '50',
                'qty' => '50',
                'size_id' => '5',
                'expiration' => '2022-08-24',
                
                'unit_cost'  => '218',
                'regular_discount'  => '16',
                'hauling_discount'  => '4.9',
                'price'  => '238.9',
                'total_cost'    =>  '9855',
                
                'isRemove'      => false,
                'isComplete'      => true,

                'supplier_id' => '1',

                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
            [
                'receiving_good_id' => '1',

                'product_code' => 'Sprite 8oz',
                'category_id'    => '1',
                'description' => 'S8',

                'stock' => '50',
                'qty' => '50',
                'size_id' => '5',
                'expiration' => '2022-08-24',
                
                'unit_cost'  => '218',
                'regular_discount'  => '16',
                'hauling_discount'  => '4.9',
                'price'  => '238.9',
                'total_cost'    =>  '9855',
                
                'isRemove'      => false,
                'isComplete'      => true,

                'supplier_id' => '1',

                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
            [
                'receiving_good_id' => '1',

                'product_code' => 'Royal 8oz',
                'category_id'    => '1',
                'description' => 'R8',

                'stock' => '50',
                'qty' => '50',
                'size_id' => '5',
                'expiration' => '2022-08-24',
                
                'unit_cost'  => '218',
                'regular_discount'  => '16',
                'hauling_discount'  => '4.9',
                'price'  => '238.9',
                'total_cost'    =>  '9855',
                
                'isRemove'      => false,
                'isComplete'      => true,

                'supplier_id' => '1',

                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
            [
                'receiving_good_id' => '1',

                'product_code' => 'Royal Lemon 8oz',
                'category_id'    => '1',
                'description' => 'RTL 8',

                'stock' => '50',
                'qty' => '50',
                'size_id' => '5',
                'expiration' => '2022-08-24',
                
                'unit_cost'  => '218',
                'regular_discount'  => '16',
                'hauling_discount'  => '4.9',
                'price'  => '238.9',
                'total_cost'    =>  '9855',
                
                'isRemove'      => false,
                'isComplete'      => true,

                'supplier_id' => '1',

                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],

            [
                'receiving_good_id' => '1',

                'product_code' => 'Coke 12oz',
                'category_id'    => '1',
                'description' => 'C12',

                'stock' => '50',
                'qty' => '50',
                'size_id' => '6',
                'expiration' => '2022-08-24',
                
                'unit_cost'  => '324',
                'regular_discount'  => '16',
                'hauling_discount'  => '7.4',
                'price'  => '347.4',
                'total_cost'    =>  '15030',
                
                'isRemove'      => false,
                'isComplete'      => true,

                'supplier_id' => '1',

                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
            [
                'receiving_good_id' => '1',

                'product_code' => 'Sprite 12oz',
                'category_id'    => '1',
                'description' => 'S12',

                'stock' => '50',
                'qty' => '50',
                'size_id' => '6',
                'expiration' => '2022-08-24',
                
                'unit_cost'  => '324',
                'regular_discount'  => '16',
                'hauling_discount'  => '7.4',
                'price'  => '347.4',
                'total_cost'    =>  '15030',
                
                'isRemove'      => false,
                'isComplete'      => true,

                'supplier_id' => '1',

                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
            [
                'receiving_good_id' => '1',

                'product_code' => 'Royal 12oz',
                'category_id'    => '1',
                'description' => 'R12',

                'stock' => '50',
                'qty' => '50',
                'size_id' => '6',
                'expiration' => '2022-08-24',
                
                'unit_cost'  => '324',
                'regular_discount'  => '16',
                'hauling_discount'  => '7.4',
                'price'  => '347.4',
                'total_cost'    =>  '15030',
                
                'isRemove'      => false,
                'isComplete'      => true,

                'supplier_id' => '1',

                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],

            [
                'receiving_good_id' => '1',

                'product_code' => 'Coke Kasalo',
                'category_id'    => '1',
                'description' => 'CK',

                'stock' => '50',
                'qty' => '50',
                'size_id' => '7',
                'expiration' => '2022-08-24',
                
                'unit_cost'  => '337',
                'regular_discount'  => '16',
                'hauling_discount'  => '7.4',
                'price'  => '360.4',
                'total_cost'    =>  '15680',
                
                'isRemove'      => false,
                'isComplete'      => true,

                'supplier_id' => '1',

                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
            [
                'receiving_good_id' => '1',

                'product_code' => 'Royal Kasalo',
                'category_id'    => '1',
                'description' => 'RK',

                'stock' => '50',
                'qty' => '50',
                'size_id' => '7',
                'expiration' => '2022-08-24',
                
                'unit_cost'  => '337',
                'regular_discount'  => '16',
                'hauling_discount'  => '7.4',
                'price'  => '360.4',
                'total_cost'    =>  '15680',
                
                'isRemove'      => false,
                'isComplete'      => true,

                'supplier_id' => '1',

                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
            [
                'receiving_good_id' => '1',

                'product_code' => 'Sprite Kasalo',
                'category_id'    => '1',
                'description' => 'SK',

                'stock' => '50',
                'qty' => '50',
                'size_id' => '7',
                'expiration' => '2022-08-24',
                
                'unit_cost'  => '337',
                'regular_discount'  => '16',
                'hauling_discount'  => '7.4',
                'price'  => '360.4',
                'total_cost'    =>  '15680',
                
                'isRemove'      => false,
                'isComplete'      => true,

                'supplier_id' => '1',

                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],

            [
                'receiving_good_id' => '1',

                'product_code' => 'Coke XL',
                'category_id'    => '1',
                'description' => 'CXL',

                'stock' => '50',
                'qty' => '50',
                'size_id' => '8',
                'expiration' => '2022-08-24',
                
                'unit_cost'  => '632',
                'regular_discount'  => '16',
                'hauling_discount'  => '7.4',
                'price'  => '655.4',
                'total_cost'    =>  '30430',
                
                'isRemove'      => false,
                'isComplete'      => true,

                'supplier_id' => '1',

                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
            [
                'receiving_good_id' => '1',

                'product_code' => 'Sprite XL',
                'category_id'    => '1',
                'description' => 'SXL',

                'stock' => '50',
                'qty' => '50',
                'size_id' => '8',
                'expiration' => '2022-08-24',
                
                'unit_cost'  => '632',
                'regular_discount'  => '16',
                'hauling_discount'  => '7.4',
                'price'  => '655.4',
                'total_cost'    =>  '30430',
                
                'isRemove'      => false,
                'isComplete'      => true,

                'supplier_id' => '1',

                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
            [
                'receiving_good_id' => '1',

                'product_code' => 'Royal XL',
                'category_id'    => '1',
                'description' => 'RXL',

                'stock' => '50',
                'qty' => '50',
                'size_id' => '8',
                'expiration' => '2022-08-24',
                
                'unit_cost'  => '632',
                'regular_discount'  => '16',
                'hauling_discount'  => '7.4',
                'price'  => '655.4',
                'total_cost'    =>  '30430',
                
                'isRemove'      => false,
                'isComplete'      => true,

                'supplier_id' => '1',

                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
            [
                'receiving_good_id' => '1',

                'product_code' => 'Coke Zero XL',
                'category_id'    => '1',
                'description' => 'CZXL',

                'stock' => '50',
                'qty' => '50',
                'size_id' => '8',
                'expiration' => '2022-08-24',
                
                'unit_cost'  => '632',
                'regular_discount'  => '16',
                'hauling_discount'  => '7.4',
                'price'  => '655.4',
                'total_cost'    =>  '30430',
                
                'isRemove'      => false,
                'isComplete'      => true,

                'supplier_id' => '1',

                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],

            [
                'receiving_good_id' => '1',

                'product_code' => 'Coke In Can',
                'category_id'    => '1',
                'description' => 'CIN',

                'stock' => '50',
                'qty' => '50',
                'size_id' => '9',
                'expiration' => '2022-08-24',
                
                'unit_cost'  => '582',
                'regular_discount'  => '16',
                'hauling_discount'  => '2.2',
                'price'  => '600.2',
                'total_cost'    =>  '28190',
                
                'isRemove'      => false,
                'isComplete'      => true,

                'supplier_id' => '1',

                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
            [
                'receiving_good_id' => '1',

                'product_code' => 'Sprite In Can',
                'category_id'    => '1',
                'description' => 'SIN',

                'stock' => '50',
                'qty' => '50',
                'size_id' => '9',
                'expiration' => '2022-08-24',
                
                'unit_cost'  => '582',
                'regular_discount'  => '16',
                'hauling_discount'  => '2.2',
                'price'  => '600.2',
                'total_cost'    =>  '28190',
                
                'isRemove'      => false,
                'isComplete'      => true,

                'supplier_id' => '1',

                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
            [
                'receiving_good_id' => '1',

                'product_code' => 'Royal In Can',
                'category_id'    => '1',
                'description' => 'RIN',

                'stock' => '50',
                'qty' => '50',
                'size_id' => '9',
                'expiration' => '2022-08-24',
                
                'unit_cost'  => '582',
                'regular_discount'  => '16',
                'hauling_discount'  => '2.2',
                'price'  => '600.2',
                'total_cost'    =>  '28190',
                
                'isRemove'      => false,
                'isComplete'      => true,

                'supplier_id' => '1',

                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
            [
                'receiving_good_id' => '1',

                'product_code' => 'Coke Zero In Can',
                'category_id'    => '1',
                'description' => 'CZIN',

                'stock' => '50',
                'qty' => '50',
                'size_id' => '9',
                'expiration' => '2022-08-24',
                
                'unit_cost'  => '582',
                'regular_discount'  => '16',
                'hauling_discount'  => '2.2',
                'price'  => '600.2',
                'total_cost'    =>  '28190',
                
                'isRemove'      => false,
                'isComplete'      => true,

                'supplier_id' => '1',

                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
            [
                'receiving_good_id' => '1',

                'product_code' => 'Sarsi In Can',
                'category_id'    => '1',
                'description' => 'SARIN',

                'stock' => '50',
                'qty' => '50',
                'size_id' => '9',
                'expiration' => '2022-08-24',
                
                'unit_cost'  => '582',
                'regular_discount'  => '16',
                'hauling_discount'  => '2.2',
                'price'  => '600.2',
                'total_cost'    =>  '28190',
                
                'isRemove'      => false,
                'isComplete'      => true,

                'supplier_id' => '1',

                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],

            [
                'receiving_good_id' => '1',

                'product_code' => 'Coke One Liter',
                'category_id'    => '1',
                'description' => 'CT1L',

                'stock' => '50',
                'qty' => '50',
                'size_id' => '10',
                'expiration' => '2022-08-24',
                
                'unit_cost'  => '419',
                'regular_discount'  => '16',
                'hauling_discount'  => '7.4',
                'price'  => '442.4',
                'total_cost'    =>  '19780',
                
                'isRemove'      => false,
                'isComplete'      => true,

                'supplier_id' => '1',

                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
           
        ];

        SalesInventory::insert($invs);

    }
}
