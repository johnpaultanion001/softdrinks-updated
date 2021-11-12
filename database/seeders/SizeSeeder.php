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
                'category_id' => '1',
                'size' => '200ML',
                'ucs' => '0.42',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
            [
                'category_id' => '1',
                'size' => '195ML',
                'ucs' => '0.41',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
            [
                'category_id' => '1',
                'size' => '295ML',
                'ucs' => '0.62',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
            [
                'category_id' => '1',
                'size' => '250ML',
                'ucs' => '0.52',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
            [
                'category_id' => '1',
                'size' => '237ML',
                'ucs' => '1',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
            [
                'category_id' => '1',
                'size' => '355ML',
                'ucs' => '1.5',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
            [
                'category_id' => '1',
                'size' => '750ML',
                'ucs' => '1.6',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
            [
                'category_id' => '1',
                'size' => '1500ML',
                'ucs' => '3.16',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
            [
                'category_id' => '1',
                'size' => '325ML',
                'ucs' => '1.4',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
            [
                'category_id' => '1',
                'size' => '1000ML',
                'ucs' => '2.1',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
            
        ];

        Size::insert($sizes);
           
    }
}
