<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Size;


class SizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sizes = [
            [
                'id'    => '1',
                'title' => '80Z',
                'category_id' => '1',
                'size' => '237 ML',
                'ucs' => '1',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
            [
                'id'    => '2',
                'title' => 'KASALO',
                'category_id' => '1',
                'size' => '750 ML',
                'ucs' => '1.5',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
            [
                'id'    => '3',
                'title' => '1.5 Liter',
                'category_id' => '1',
                'size' => '1500 ML',
                'ucs' => '3.1',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
            [
                'id'    => '4',
                'title' => '',
                'category_id' => '1',
                'size' => '200 ML',
                'ucs' => '.42',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],   
            [
                'id'    => '5',
                'title' => '1 Liter',
                'category_id' => '1',
                'size' => '1000 ML',
                'ucs' => '2.1',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ], 
            [
                'id'    => '6',
                'title' => 'Can',
                'category_id' => '3',
                'size' => '325 ML',
                'ucs' => '1.3',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],                
        ];

        Size::insert($sizes);
           
    }
}
