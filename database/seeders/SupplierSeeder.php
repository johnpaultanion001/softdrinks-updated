<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Supplier;


class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $suppliers = [
            [
                'id'    => 1,
                'name' => 'Coca Cola Company',
                'address' => 'Antipolo Branch',
                'contact_number' => '1234567423',
                'remarks' => 'Monday Morning',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
                
            ],
            [
                'id'    => 2,
                'name' => 'Sprite Company',
                'address' => 'Pasig Branch',
                'contact_number' => '1234567423',
                'remarks' => 'Tuesday Morning',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
        ];

        Supplier::insert($suppliers);
    }
}
