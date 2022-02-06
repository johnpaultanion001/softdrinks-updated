<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\EmptyBottlesInventory;

class EmptyBottlesInventorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        date_default_timezone_set('Asia/Manila');
        $inv = [
            [
                'product_id' => '1',
                'qty'        => 21,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
        ];

        EmptyBottlesInventory::insert($inv);
    }
}
