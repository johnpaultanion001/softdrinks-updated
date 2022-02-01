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
                'price_type' => 'NO LESS',
                'discount' => '0',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
            [
                'price_type' => '10 PHP',
                'discount' => '10',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
            [
                'price_type' => '8 PHP',
                'discount' => '8',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
            [
                'price_type' => '5 PHP',
                'discount' => '5',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
            [
                'price_type' => '3 PHP',
                'discount' => '3',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
            [
                'price_type' => '2 PHP',
                'discount' => '2',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
           
          
        ];

        PriceType::insert($pricetypes);
    }
}
