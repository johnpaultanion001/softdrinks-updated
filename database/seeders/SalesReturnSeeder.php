<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SalesReturn;

class SalesReturnSeeder extends Seeder
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
                'salesinvoice_id' => '1001',
                'product_id'      => '1',
                'return_qty'      => '25',
                'unit_price'      => '5',
                'amount'          => '125',
                'status_id'       => '1',
                'type_of_return'  => 'EMPTY',
                'isComplete'      => true,
                'user_id'         => '1',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
        ];

        SalesReturn::insert($returns);
    }
}
