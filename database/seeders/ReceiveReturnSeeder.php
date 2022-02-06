<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\RecieveReturn;

class ReceiveReturnSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $returns = [
            [
               
                'receiving_good_id' => '1',
                'product_id' => '1',
                'return_qty' => '2',
                'unit_price' => '22',
                'amount' => '44',
                'status_id' => '1',
                'type_of_return' => 'EMPTY',
                'isComplete'      => true,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
            [
               
                'receiving_good_id' => '1',
                'product_id' => '1',
                'return_qty' => '2',
                'unit_price' => '22',
                'amount' => '44',
                'status_id' => '1',
                'type_of_return' => 'EMPTY',
                'isComplete'      => true,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
        ];

        RecieveReturn::insert($returns);
    }
}
