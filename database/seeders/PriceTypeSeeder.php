<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PriceType;

class PriceTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pricetypes = [
            [
                'id'    => '1',
                'price_type' => 'Price type 1',
                'discount' => '0',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
            [
                'id'    => '2',
                'price_type' => 'Price type 2',
                'discount' => '100',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
           
          
        ];

        PriceType::insert($pricetypes);
    }
}
