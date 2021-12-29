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

                'qty' => '50',
                'size_id' => '1',
                'expiration' => '2022-08-24',
                
                'unit_cost'  => '94',
                'regular_discount'  => '6',
                'hauling_discount'  => '0.9',
                'price'  => '94',
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

                'qty' => '50',
                'size_id' => '1',
                'expiration' => '2022-08-24',
                
                'unit_cost'  => '94',
                'regular_discount'  => '6',
                'hauling_discount'  => '0.9',
                'price'  => '94',
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

                'qty' => '50',
                'size_id' => '1',
                'expiration' => '2022-08-24',
                
                'unit_cost'  => '94',
                'regular_discount'  => '6',
                'hauling_discount'  => '0.9',
                'price'  => '94',
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

                'qty' => '50',
                'size_id' => '1',
                'expiration' => '2022-08-24',
                
                'unit_cost'  => '94',
                'regular_discount'  => '6',
                'hauling_discount'  => '0.9',
                'price'  => '94',
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

                'qty' => '50',
                'size_id' => '2',
                'expiration' => '2022-08-24',
                
                'unit_cost'  => '94',
                'regular_discount'  => '6',
                'hauling_discount'  => '0.9',
                'price'  => '94',
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

                'qty' => '50',
                'size_id' => '3',
                'expiration' => '2022-08-24',
                
                'unit_cost'  => '127',
                'regular_discount'  => '6',
                'hauling_discount'  => '1.1',
                'price'   => '127',
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

                'qty' => '50',
                'size_id' => '3',
                'expiration' => '2022-08-24',
                
                'unit_cost'  => '127',
                'regular_discount'  => '6',
                'hauling_discount'  => '1.1',
                'price'   => '127',
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

                'qty' => '50',
                'size_id' => '4',
                'expiration' => '2022-08-24',
                
                'unit_cost'  => '127',
                'regular_discount'  => '6',
                'hauling_discount'  => '1.1',
                'price'   => '127',
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

                'qty' => '50',
                'size_id' => '4',
                'expiration' => '2022-08-24',
                
                'unit_cost'  => '127',
                'regular_discount'  => '6',
                'hauling_discount'  => '1.1',
                'price'   => '127',
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

                'qty' => '50',
                'size_id' => '5',
                'expiration' => '2022-08-24',
                
                'unit_cost'  => '218',
                'regular_discount'  => '16',
                'hauling_discount'  => '4.9',
                'price'  => '218',
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

                'qty' => '50',
                'size_id' => '5',
                'expiration' => '2022-08-24',
                
                'unit_cost'  => '218',
                'regular_discount'  => '16',
                'hauling_discount'  => '4.9',
                'price'  => '218',
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

                'qty' => '50',
                'size_id' => '5',
                'expiration' => '2022-08-24',
                
                'unit_cost'  => '218',
                'regular_discount'  => '16',
                'hauling_discount'  => '4.9',
                'price'  => '218',
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

                'qty' => '50',
                'size_id' => '5',
                'expiration' => '2022-08-24',
                
                'unit_cost'  => '218',
                'regular_discount'  => '16',
                'hauling_discount'  => '4.9',
                'price'  => '218',
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

                'qty' => '50',
                'size_id' => '6',
                'expiration' => '2022-08-24',
                
                'unit_cost'  => '324',
                'regular_discount'  => '16',
                'hauling_discount'  => '7.4',
                'price'  => '324',
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

                'qty' => '50',
                'size_id' => '6',
                'expiration' => '2022-08-24',
                
                'unit_cost'  => '324',
                'regular_discount'  => '16',
                'hauling_discount'  => '7.4',
                'price'  => '324',
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

                'qty' => '50',
                'size_id' => '6',
                'expiration' => '2022-08-24',
                
                'unit_cost'  => '324',
                'regular_discount'  => '16',
                'hauling_discount'  => '7.4',
                'price'  => '324',
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

                'qty' => '50',
                'size_id' => '7',
                'expiration' => '2022-08-24',
                
                'unit_cost'  => '337',
                'regular_discount'  => '16',
                'hauling_discount'  => '7.4',
                'price'  => '337',
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

                'qty' => '50',
                'size_id' => '7',
                'expiration' => '2022-08-24',
                
                'unit_cost'  => '337',
                'regular_discount'  => '16',
                'hauling_discount'  => '7.4',
                'price'  => '337',
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

                'qty' => '50',
                'size_id' => '7',
                'expiration' => '2022-08-24',
                
                'unit_cost'  => '337',
                'regular_discount'  => '16',
                'hauling_discount'  => '7.4',
                'price'  => '337',
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

                'qty' => '50',
                'size_id' => '8',
                'expiration' => '2022-08-24',
                
                'unit_cost'  => '632',
                'regular_discount'  => '16',
                'hauling_discount'  => '7.4',
                'price'  => '632',
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

                'qty' => '50',
                'size_id' => '8',
                'expiration' => '2022-08-24',
                
                'unit_cost'  => '632',
                'regular_discount'  => '16',
                'hauling_discount'  => '7.4',
                'price'  => '632',
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

                'qty' => '50',
                'size_id' => '8',
                'expiration' => '2022-08-24',
                
                'unit_cost'  => '632',
                'regular_discount'  => '16',
                'hauling_discount'  => '7.4',
                'price'  => '632',
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

                'qty' => '50',
                'size_id' => '8',
                'expiration' => '2022-08-24',
                
                'unit_cost'  => '632',
                'regular_discount'  => '16',
                'hauling_discount'  => '7.4',
                'price'  => '632',
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

                'qty' => '50',
                'size_id' => '9',
                'expiration' => '2022-08-24',
                
                'unit_cost'  => '582',
                'regular_discount'  => '16',
                'hauling_discount'  => '2.2',
                'price'  => '582',
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

                'qty' => '50',
                'size_id' => '9',
                'expiration' => '2022-08-24',
                
                'unit_cost'  => '582',
                'regular_discount'  => '16',
                'hauling_discount'  => '2.2',
                'price'  => '582',
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

                'qty' => '50',
                'size_id' => '9',
                'expiration' => '2022-08-24',
                
                'unit_cost'  => '582',
                'regular_discount'  => '16',
                'hauling_discount'  => '2.2',
                'price'  => '582',
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

                'qty' => '50',
                'size_id' => '9',
                'expiration' => '2022-08-24',
                
                'unit_cost'  => '582',
                'regular_discount'  => '16',
                'hauling_discount'  => '2.2',
                'price'  => '582',
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

                'qty' => '50',
                'size_id' => '9',
                'expiration' => '2022-08-24',
                
                'unit_cost'  => '582',
                'regular_discount'  => '16',
                'hauling_discount'  => '2.2',
                'price'  => '582',
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

                'qty' => '50',
                'size_id' => '10',
                'expiration' => '2022-08-24',
                
                'unit_cost'  => '419',
                'regular_discount'  => '16',
                'hauling_discount'  => '7.4',
                'price'  => '419',
                'total_cost'    =>  '19780',
                
                'isRemove'      => false,
                'isComplete'      => true,

                'supplier_id' => '1',

                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],

            //water/juices

            [
                'receiving_good_id' => '2',

                'product_code'      => 'Minute Maid Apple',
                'category_id'       => '1',
                'description'       => 'MA200',

                'qty'               => '50',
                'size_id'           => '11',
                'expiration'        => '2022-08-24',
                
                'unit_cost'         => '69',
                'regular_discount'  => '3',
                'hauling_discount'  => '0.9',
                'price'             => '69',
                'total_cost'        => '3255',
                
                'isRemove'          => false,
                'isComplete'        => true,

                'supplier_id'       => '2',

                'created_at'        => date("Y-m-d H:i:s"),
                'updated_at'        => date("Y-m-d H:i:s"),
            ],
            [
                'receiving_good_id' => '2',

                'product_code'      => 'Minute Maid Orange',
                'category_id'       => '1',
                'description'       => 'MO200',

                'qty'               => '50',
                'size_id'           => '11',
                'expiration'        => '2022-08-24',
                
                'unit_cost'         => '69',
                'regular_discount'  => '3',
                'hauling_discount'  => '0.9',
                'price'             => '69',
                'total_cost'        => '3255',
                
                'isRemove'          => false,
                'isComplete'        => true,

                'supplier_id'       => '2',

                'created_at'        => date("Y-m-d H:i:s"),
                'updated_at'        => date("Y-m-d H:i:s"),
            ],
            [
                'receiving_good_id' => '2',

                'product_code'      => 'Minute Maid Pineapple',
                'category_id'       => '1',
                'description'       => 'MP200',

                'qty'               => '50',
                'size_id'           => '11',
                'expiration'        => '2022-08-24',
                
                'unit_cost'         => '69',
                'regular_discount'  => '3',
                'hauling_discount'  => '0.9',
                'price'             => '69',
                'total_cost'        => '3255',
                
                'isRemove'          => false,
                'isComplete'        => true,

                'supplier_id'       => '2',

                'created_at'        => date("Y-m-d H:i:s"),
                'updated_at'        => date("Y-m-d H:i:s"),
            ],
            [
                'receiving_good_id' => '2',

                'product_code'      => 'Minute Maid Mango',
                'category_id'       => '1',
                'description'       => 'MMA200',

                'qty'               => '50',
                'size_id'           => '11',
                'expiration'        => '2022-08-24',
                
                'unit_cost'         => '69',
                'regular_discount'  => '3',
                'hauling_discount'  => '0.9',
                'price'             => '69',
                'total_cost'        => '3255',
                
                'isRemove'          => false,
                'isComplete'        => true,

                'supplier_id'       => '2',

                'created_at'        => date("Y-m-d H:i:s"),
                'updated_at'        => date("Y-m-d H:i:s"),
            ],
            [
                'receiving_good_id' => '2',

                'product_code'      => 'Minute Maid 250',
                'category_id'       => '1',
                'description'       => 'M250',

                'qty'               => '50',
                'size_id'           => '12',
                'expiration'        => '2022-08-24',
                
                'unit_cost'         => '110',
                'regular_discount'  => '10',
                'hauling_discount'  => '1.1',
                'price'             => '110',
                'total_cost'        => '4945',
                
                'isRemove'          => false,
                'isComplete'        => true,

                'supplier_id'       => '2',

                'created_at'        => date("Y-m-d H:i:s"),
                'updated_at'        => date("Y-m-d H:i:s"),
            ],
            [
                'receiving_good_id' => '2',

                'product_code'      => 'Minute Maid 800',
                'category_id'       => '1',
                'description'       => 'M800',

                'qty'               => '50',
                'size_id'           => '13',
                'expiration'        => '2022-08-24',
                
                'unit_cost'         => '301',
                'regular_discount'  => '16',
                'hauling_discount'  => '7.4',
                'price'             => '301',
                'total_cost'        => '13880',
                
                'isRemove'          => false,
                'isComplete'        => true,

                'supplier_id'       => '2',

                'created_at'        => date("Y-m-d H:i:s"),
                'updated_at'        => date("Y-m-d H:i:s"),
            ],
            [
                'receiving_good_id' => '2',

                'product_code'      => 'Nutri Boost Choco',
                'category_id'       => '1',
                'description'       => 'NC',

                'qty'               => '50',
                'size_id'           => '14',
                'expiration'        => '2022-08-24',
                
                'unit_cost'         => '102',
                'regular_discount'  => '3',
                'hauling_discount'  => '0.9',
                'price'             => '102',
                'total_cost'        => '4905',
                
                'isRemove'          => false,
                'isComplete'        => true,

                'supplier_id'       => '2',

                'created_at'        => date("Y-m-d H:i:s"),
                'updated_at'        => date("Y-m-d H:i:s"),
            ],
            [
                'receiving_good_id' => '2',

                'product_code'      => 'Nutri Boost Orange',
                'category_id'       => '1',
                'description'       => 'NO',

                'qty'               => '50',
                'size_id'           => '14',
                'expiration'        => '2022-08-24',
                
                'unit_cost'         => '102',
                'regular_discount'  => '3',
                'hauling_discount'  => '0.9',
                'price'             => '102',
                'total_cost'        => '4905',
                
                'isRemove'          => false,
                'isComplete'        => true,

                'supplier_id'       => '2',

                'created_at'        => date("Y-m-d H:i:s"),
                'updated_at'        => date("Y-m-d H:i:s"),
            ],
            [
                'receiving_good_id' => '2',

                'product_code'      => 'Nutri Boost Strawberry',
                'category_id'       => '1',
                'description'       => 'NS',

                'qty'               => '50',
                'size_id'           => '14',
                'expiration'        => '2022-08-24',
                
                'unit_cost'         => '102',
                'regular_discount'  => '3',
                'hauling_discount'  => '0.9',
                'price'             => '102',
                'total_cost'        => '4905',
                
                'isRemove'          => false,
                'isComplete'        => true,

                'supplier_id'       => '2',

                'created_at'        => date("Y-m-d H:i:s"),
                'updated_at'        => date("Y-m-d H:i:s"),
            ],
            [
                'receiving_good_id' => '2',

                'product_code'      => 'Real Leaf 480',
                'category_id'       => '1',
                'description'       => 'RL480',

                'qty'               => '50',
                'size_id'           => '15',
                'expiration'        => '2022-08-24',
                
                'unit_cost'         => '414',
                'regular_discount'  => '16',
                'hauling_discount'  => '3.4',
                'price'             => '414',
                'total_cost'        => '19730',
                
                'isRemove'          => false,
                'isComplete'        => true,

                'supplier_id'       => '2',

                'created_at'        => date("Y-m-d H:i:s"),
                'updated_at'        => date("Y-m-d H:i:s"),
            ],
            [
                'receiving_good_id' => '2',

                'product_code'      => 'Wilkins Pure 330 x 12',
                'category_id'       => '1',
                'description'       => 'WP330 X 12',

                'qty'               => '50',
                'size_id'           => '16',
                'expiration'        => '2022-08-24',
                
                'unit_cost'         => '77.5',
                'regular_discount'  => '6.5',
                'hauling_discount'  => '1.36',
                'price'             => '77.5',
                'total_cost'        => '3482',
                
                'isRemove'          => false,
                'isComplete'        => true,

                'supplier_id'       => '2',

                'created_at'        => date("Y-m-d H:i:s"),
                'updated_at'        => date("Y-m-d H:i:s"),
            ],
            [
                'receiving_good_id' => '2',

                'product_code'      => 'Wilkins Pure 330',
                'category_id'       => '1',
                'description'       => 'WP330',

                'qty'               => '50',
                'size_id'           => '16',
                'expiration'        => '2022-08-24',
                
                'unit_cost'         => '194',
                'regular_discount'  => '16',
                'hauling_discount'  => '3.4',
                'price'             => '194',
                'total_cost'        => '8730',
                
                'isRemove'          => false,
                'isComplete'        => true,

                'supplier_id'       => '2',

                'created_at'        => date("Y-m-d H:i:s"),
                'updated_at'        => date("Y-m-d H:i:s"),
            ],
            [
                'receiving_good_id' => '2',

                'product_code'      => 'Wilkins Pure 500',
                'category_id'       => '1',
                'description'       => 'WP500',

                'qty'               => '50',
                'size_id'           => '17',
                'expiration'        => '2022-08-24',
                
                'unit_cost'         => '200',
                'regular_discount'  => '16',
                'hauling_discount'  => '3.4',
                'price'             => '200',
                'total_cost'        => '9030',
                
                'isRemove'          => false,
                'isComplete'        => true,

                'supplier_id'       => '2',

                'created_at'        => date("Y-m-d H:i:s"),
                'updated_at'        => date("Y-m-d H:i:s"),
            ],
            [
                'receiving_good_id' => '2',

                'product_code'      => 'Wilkins Pure 500',
                'category_id'       => '1',
                'description'       => 'WP500',

                'qty'               => '50',
                'size_id'           => '17',
                'expiration'        => '2022-08-24',
                
                'unit_cost'         => '200',
                'regular_discount'  => '16',
                'hauling_discount'  => '3.4',
                'price'             => '200',
                'total_cost'        => '9030',
                
                'isRemove'          => false,
                'isComplete'        => true,

                'supplier_id'       => '2',

                'created_at'        => date("Y-m-d H:i:s"),
                'updated_at'        => date("Y-m-d H:i:s"),
            ],
            [
                'receiving_good_id' => '2',

                'product_code'      => 'Wilkins Pure 1000',
                'category_id'       => '1',
                'description'       => 'WP1L',

                'qty'               => '50',
                'size_id'           => '18',
                'expiration'        => '2022-08-24',
                
                'unit_cost'         => '169',
                'regular_discount'  => '16',
                'hauling_discount'  => '7.4',
                'price'             => '169',
                'total_cost'        => '7280',
                
                'isRemove'          => false,
                'isComplete'        => true,

                'supplier_id'       => '2',

                'created_at'        => date("Y-m-d H:i:s"),
                'updated_at'        => date("Y-m-d H:i:s"),
            ],
            [
                'receiving_good_id' => '2',

                'product_code'      => 'Wilkins Distilled 1000',
                'category_id'       => '1',
                'description'       => 'W1L',

                'qty'               => '50',
                'size_id'           => '18',
                'expiration'        => '2022-08-24',
                
                'unit_cost'         => '264',
                'regular_discount'  => '16',
                'hauling_discount'  => '7.4',
                'price'             => '264',
                'total_cost'        => '12030',
                
                'isRemove'          => false,
                'isComplete'        => true,

                'supplier_id'       => '2',

                'created_at'        => date("Y-m-d H:i:s"),
                'updated_at'        => date("Y-m-d H:i:s"),
            ],
            [
                'receiving_good_id' => '2',

                'product_code'      => 'Wilkins Distilled 7000',
                'category_id'       => '1',
                'description'       => 'W7L',

                'qty'               => '50',
                'size_id'           => '19',
                'expiration'        => '2022-08-24',
                
                'unit_cost'         => '215',
                'regular_discount'  => '16',
                'hauling_discount'  => '7.4',
                'price'             => '215',
                'total_cost'        => '9580',
                
                'isRemove'          => false,
                'isComplete'        => true,

                'supplier_id'       => '2',

                'created_at'        => date("Y-m-d H:i:s"),
                'updated_at'        => date("Y-m-d H:i:s"),
            ],
        ];

        SalesInventory::insert($invs);

    }
}
