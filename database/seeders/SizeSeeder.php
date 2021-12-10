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
            //SOFTDRINKS
            [
                'category_id' => '1',
                'size' => '200ML',
                'ucs' => '0.42',
                'status' => 'SOFTDRINKS',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
            [
                'category_id' => '1',
                'size' => '195ML',
                'ucs' => '0.41',
                'status' => 'SOFTDRINKS',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
            [
                'category_id' => '1',
                'size' => '295ML',
                'ucs' => '0.62',
                'status' => 'SOFTDRINKS',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
            [
                'category_id' => '1',
                'size' => '250ML',
                'ucs' => '0.52',
                'status' => 'SOFTDRINKS',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
            [
                'category_id' => '1',
                'size' => '237ML',
                'ucs' => '1',
                'status' => 'SOFTDRINKS',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
            [
                'category_id' => '1',
                'size' => '355ML',
                'ucs' => '1.5',
                'status' => 'SOFTDRINKS',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
            [
                'category_id' => '1',
                'size' => '750ML',
                'ucs' => '1.6',
                'status' => 'SOFTDRINKS',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
            [
                'category_id' => '1',
                'size' => '1500ML',
                'ucs' => '3.16',
                'status' => 'SOFTDRINKS',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
            [
                'category_id' => '1',
                'size' => '325ML',
                'ucs' => '1.4',
                'status' => 'SOFTDRINKS',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
            [
                'category_id' => '1',
                'size' => '1000ML',
                'ucs' => '2.1',
                'status' => 'SOFTDRINKS',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],

            //No UCS
            [
                'category_id' => null,
                'size' => '180ML',
                'ucs' => null,
                'status' => 'NO-UCS',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
            [
                'category_id' => null,
                'size' => '250ML',
                'ucs' => null,
                'status' => 'NO-UCS',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
            [
                'category_id' => null,
                'size' => '8000ML',
                'ucs' => null,
                'status' => 'NO-UCS',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
            [
                'category_id' => null,
                'size' => '110ML',
                'ucs' => null,
                'status' => 'NO-UCS',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
            [
                'category_id' => null,
                'size' => '480ML',
                'ucs' => null,
                'status' => 'NO-UCS',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
            [
                'category_id' => null,
                'size' => '330ML',
                'ucs' => null,
                'status' => 'NO-UCS',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
            [
                'category_id' => null,
                'size' => '500ML',
                'ucs' => null,
                'status' => 'NO-UCS',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
            [
                'category_id' => null,
                'size' => '1000ML',
                'ucs' => null,
                'status' => 'NO-UCS',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
            [
                'category_id' => null,
                'size' => '7000ML',
                'ucs' => null,
                'status' => 'NO-UCS',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
        ];

        Size::insert($sizes);
           
    }
}
