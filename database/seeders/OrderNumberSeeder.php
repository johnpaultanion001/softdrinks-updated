<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\OrderNumber;

class OrderNumberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $number = [
            [
                'id'    => '1',
                'order_number' => '100002',
                'salesinvoice_id' => '100002',
            ],
           
        ];

        OrderNumber::insert($number);
    }
}
