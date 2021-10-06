<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\UCS;

class UCSSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        date_default_timezone_set('Asia/Manila');
        $ucs = [
            [
                'id'    => '1',
                'purchase_order_number_id' => 1,
                'product_id' => '1221121',
                'qty' => 200,
                'isPurchase' => 1,
                'ucs_size' => 3.10,
                'ucs' => 620,
            ],
            [
                'id'    => '2',
                'purchase_order_number_id' => 1,
                'product_id' => '1221122',
                'qty' => 200,
                'isPurchase' => 1,
                'ucs_size' => 3.10,
                'ucs' => 620,
            ],


            [
                'id'    => '3',
                'purchase_order_number_id' => 1,
                'product_id' => '1221123',
                'qty' => 20,
                'isPurchase' => 1,
                'ucs_size' => 1.50,
                'ucs' => 30,
            ],

            [
                'id'    => '4',
                'purchase_order_number_id' => 1,
                'product_id' => '1221124',
                'qty' => 20,
                'isPurchase' => 1,
                'ucs_size' => 1.50,
                'ucs' => 30,
            ],

            [
                'id'    => '5',
                'purchase_order_number_id' => 1,
                'product_id' => '1221126',
                'qty' => 20,
                'isPurchase' => 1,
                'ucs_size' => 1.50,
                'ucs' => 30,
            ],
           
        ];

        UCS::insert($ucs);
    }
}
