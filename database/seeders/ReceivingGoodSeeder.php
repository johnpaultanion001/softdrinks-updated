<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ReceivingGood;

class ReceivingGoodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $goods = [
            [
                'user_id' => '1',
                'supplier_id' => '1',
                'location_id' => '1',

                'doc_no' => '123',
                'entry_date' => date("Y-m-d H:i:s"),
                'po_no' => '123',
                'po_date' => date("Y-m-d H:i:s"),

                'plate_number' => 'ABC 123',
                'name_of_a_driver' => 'John Paul Tanion',
                'trade_discount' => '0',
                'terms_discount' => '0',

                'total_orders' => '29',
                'over_all_cost' => '459755',
                'cash1' => '459667',
                
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
            [
                'user_id' => '1',
                'supplier_id' => '2',
                'location_id' => '1',

                'doc_no' => '123',
                'entry_date' => date("Y-m-d H:i:s"),
                'po_no' => '123',
                'po_date' => date("Y-m-d H:i:s"),

                'plate_number' => 'ABC 123',
                'name_of_a_driver' => 'John Paul Tanion',
                'trade_discount' => '0',
                'terms_discount' => '0',

                'total_orders' => '16',
                'over_all_cost' => '113422',
                'cash1' => '125452',
               

                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
            
        ];
        ReceivingGood::insert($goods);
    }
}
