<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\UCS;

class UCSSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        date_default_timezone_set('Asia/Manila');
        $ucs = [
            [
                'receiving_good_id' => 1,
                'product_id'        => 1,
                'ucs_size'          => '0.42',
                'ucs'               => '21',
                'qty'               => '50',
                'isComplete'        => 1,
                'status_size'       => 'SOFTDRINKS',
                'created_at'        => ("2021-11-05"),
                'updated_at'        => date("Y-m-d H:i:s"),
            ],
            [
                'receiving_good_id' => 1,
                'product_id'        => 2,
                'ucs_size'          => '0.42',
                'ucs'               => '21',
                'qty'               => '50',
                'isComplete'        => 1,
                'status_size'       => 'SOFTDRINKS',
                'created_at'        => ("2021-11-05"),
                'updated_at'        => date("Y-m-d H:i:s"),
            ],
            [
                'receiving_good_id' => 1,
                'product_id'        => 3,
                'ucs_size'          => '0.42',
                'ucs'               => '21',
                'qty'               => '50',
                'isComplete'        => 1,
                'status_size'       => 'SOFTDRINKS',
                'created_at'        => date("Y-m-d H:i:s"),
                'updated_at'        => date("Y-m-d H:i:s"),
            ],
            [
                'receiving_good_id' => 1,
                'product_id'        => 4,
                'ucs_size'          => '0.42',
                'ucs'               => '21',
                'qty'               => '50',
                'isComplete'        => 1,
                'status_size'       => 'SOFTDRINKS',
                'created_at'        => date("Y-m-d H:i:s"),
                'updated_at'        => date("Y-m-d H:i:s"),
            ],
            [
                'receiving_good_id' => 1,
                'product_id'        => 5,
                'ucs_size'          => '0.41',
                'ucs'               => '20.50',
                'qty'               => '50',
                'isComplete'        => 1,
                'status_size'       => ("2020-11-05"),
                'created_at'        => date("Y-m-d H:i:s"),
                'updated_at'        => date("Y-m-d H:i:s"),
            ],
            [
                'receiving_good_id' => 1,
                'product_id'        => 6,
                'ucs_size'          => '0.62',
                'ucs'               => '31',
                'qty'               => '50',
                'isComplete'        => 1,
                'status_size'       => 'SOFTDRINKS',
                'created_at'        => date("Y-m-d H:i:s"),
                'updated_at'        => date("Y-m-d H:i:s"),
            ],
            [
                'receiving_good_id' => 1,
                'product_id'        => 7,
                'ucs_size'          => '0.62',
                'ucs'               => '31',
                'qty'               => '50',
                'isComplete'        => 1,
                'status_size'       => 'SOFTDRINKS',
                'created_at'        => ("2021-11-05"),
                'updated_at'        => date("Y-m-d H:i:s"),
            ],
            [
                'receiving_good_id' => 1,
                'product_id'        => 8,
                'ucs_size'          => '0.52',
                'ucs'               => '26',
                'qty'               => '50',
                'isComplete'        => 1,
                'status_size'       => 'SOFTDRINKS',
                'created_at'        => date("Y-m-d H:i:s"),
                'updated_at'        => date("Y-m-d H:i:s"),
            ],
            [
                'receiving_good_id' => 1,
                'product_id'        => 9,
                'ucs_size'          => '0.52',
                'ucs'               => '26',
                'qty'               => '50',
                'isComplete'        => 1,
                'status_size'       => 'SOFTDRINKS',
                'created_at'        => date("Y-m-d H:i:s"),
                'updated_at'        => date("Y-m-d H:i:s"),
            ],
            [
                'receiving_good_id' => 1,
                'product_id'        => 10,
                'ucs_size'          => '1',
                'ucs'               => '50',
                'qty'               => '50',
                'isComplete'        => 1,
                'status_size'       => 'SOFTDRINKS',
                'created_at'        => ("2021-11-05"),
                'updated_at'        => date("Y-m-d H:i:s"),
            ],
            [
                'receiving_good_id' => 1,
                'product_id'        => 11,
                'ucs_size'          => '1',
                'ucs'               => '50',
                'qty'               => '50',
                'isComplete'        => 1,
                'status_size'       => 'SOFTDRINKS',
                'created_at'        => date("Y-m-d H:i:s"),
                'updated_at'        => date("Y-m-d H:i:s"),
            ],
            [
                'receiving_good_id' => 1,
                'product_id'        => 12,
                'ucs_size'          => '1',
                'ucs'               => '50',
                'qty'               => '50',
                'isComplete'        => 1,
                'status_size'       => 'SOFTDRINKS',
                'created_at'        => date("Y-m-d H:i:s"),
                'updated_at'        => date("Y-m-d H:i:s"),
            ],
            [
                'receiving_good_id' => 1,
                'product_id'        => 13,
                'ucs_size'          => '1',
                'ucs'               => '50',
                'qty'               => '50',
                'isComplete'        => 1,
                'status_size'       => 'SOFTDRINKS',
                'created_at'        => date("Y-m-d H:i:s"),
                'updated_at'        => date("Y-m-d H:i:s"),
            ],
            [
                'receiving_good_id' => 1,
                'product_id'        => 14,
                'ucs_size'          => '1.50',
                'ucs'               => '75',
                'qty'               => '50',
                'isComplete'        => 1,
                'status_size'       => 'SOFTDRINKS',
                'created_at'        => ("2020-11-05"),
                'updated_at'        => date("Y-m-d H:i:s"),
            ],
            [
                'receiving_good_id' => 1,
                'product_id'        => 15,
                'ucs_size'          => '1.50',
                'ucs'               => '75',
                'qty'               => '50',
                'isComplete'        => 1,
                'status_size'       => 'SOFTDRINKS',
                'created_at'        => date("Y-m-d H:i:s"),
                'updated_at'        => date("Y-m-d H:i:s"),
            ],
            [
                'receiving_good_id' => 1,
                'product_id'        => 16,
                'ucs_size'          => '1.50',
                'ucs'               => '75',
                'qty'               => '50',
                'isComplete'        => 1,
                'status_size'       => 'SOFTDRINKS',
                'created_at'        => date("Y-m-d H:i:s"),
                'updated_at'        => date("Y-m-d H:i:s"),
            ],
            [
                'receiving_good_id' => 1,
                'product_id'        => 17,
                'ucs_size'          => '1.60',
                'ucs'               => '80',
                'qty'               => '50',
                'isComplete'        => 1,
                'status_size'       => 'SOFTDRINKS',
                'created_at'        => date("Y-m-d H:i:s"),
                'updated_at'        => date("Y-m-d H:i:s"),
            ],
            [
                'receiving_good_id' => 1,
                'product_id'        => 18,
                'ucs_size'          => '1.60',
                'ucs'               => '80',
                'qty'               => '50',
                'isComplete'        => 1,
                'status_size'       => 'SOFTDRINKS',
                'created_at'        => date("Y-m-d H:i:s"),
                'updated_at'        => date("Y-m-d H:i:s"),
            ],
            [
                'receiving_good_id' => 1,
                'product_id'        => 19,
                'ucs_size'          => '1.60',
                'ucs'               => '80',
                'qty'               => '50',
                'isComplete'        => 1,
                'status_size'       => 'SOFTDRINKS',
                'created_at'        => ("2021-11-06"),
                'updated_at'        => date("Y-m-d H:i:s"),
            ],
            [
                'receiving_good_id' => 1,
                'product_id'        => 20,
                'ucs_size'          => '3.16',
                'ucs'               => '158',
                'qty'               => '50',
                'isComplete'        => 1,
                'status_size'       => 'SOFTDRINKS',
                'created_at'        => date("Y-m-d H:i:s"),
                'updated_at'        => date("Y-m-d H:i:s"),
            ],
            [
                'receiving_good_id' => 1,
                'product_id'        => 21,
                'ucs_size'          => '3.16',
                'ucs'               => '158',
                'qty'               => '50',
                'isComplete'        => 1,
                'status_size'       => 'SOFTDRINKS',
                'created_at'        => date("Y-m-d H:i:s"),
                'updated_at'        => date("Y-m-d H:i:s"),
            ],
            [
                'receiving_good_id' => 1,
                'product_id'        => 22,
                'ucs_size'          => '3.16',
                'ucs'               => '158',
                'qty'               => '50',
                'isComplete'        => 1,
                'status_size'       => 'SOFTDRINKS',
                'created_at'        => ("2021-11-07"),
                'updated_at'        => date("Y-m-d H:i:s"),
            ],
            [
                'receiving_good_id' => 1,
                'product_id'        => 23,
                'ucs_size'          => '3.16',
                'ucs'               => '158',
                'qty'               => '50',
                'isComplete'        => 1,
                'status_size'       => 'SOFTDRINKS',
                'created_at'        => ("2020-11-07"),
                'updated_at'        => date("Y-m-d H:i:s"),
            ],
            [
                'receiving_good_id' => 1,
                'product_id'        => 24,
                'ucs_size'          => '1.40',
                'ucs'               => '70',
                'qty'               => '50',
                'isComplete'        => 1,
                'status_size'       => 'SOFTDRINKS',
                'created_at'        => ("2020-11-07"),
                'updated_at'        => date("Y-m-d H:i:s"),
            ],
            [
                'receiving_good_id' => 1,
                'product_id'        => 25,
                'ucs_size'          => '1.40',
                'ucs'               => '70',
                'qty'               => '50',
                'isComplete'        => 1,
                'status_size'       => 'SOFTDRINKS',
                'created_at'        => ("2020-11-07"),
                'updated_at'        => date("Y-m-d H:i:s"),
            ],
            [
                'receiving_good_id' => 1,
                'product_id'        => 26,
                'ucs_size'          => '1.40',
                'ucs'               => '70',
                'qty'               => '50',
                'isComplete'        => 1,
                'status_size'       => 'SOFTDRINKS',
                'created_at'        => ("2020-11-07"),
                'updated_at'        => date("Y-m-d H:i:s"),
            ],
            [
                'receiving_good_id' => 1,
                'product_id'        => 27,
                'ucs_size'          => '1.40',
                'ucs'               => '70',
                'qty'               => '50',
                'isComplete'        => 1,
                'status_size'       => 'SOFTDRINKS',
                'created_at'        => date("Y-m-d H:i:s"),
                'updated_at'        => date("Y-m-d H:i:s"),
            ],
            [
                'receiving_good_id' => 1,
                'product_id'        => 28,
                'ucs_size'          => '1.40',
                'ucs'               => '70',
                'qty'               => '50',
                'isComplete'        => 1,
                'status_size'       => 'SOFTDRINKS',
                'created_at'        => ("2020-11-07"),
                'updated_at'        => date("Y-m-d H:i:s"),
            ],
            [
                'receiving_good_id' => 1,
                'product_id'        => 29,
                'ucs_size'          => '2.10',
                'ucs'               => '105',
                'qty'               => '50',
                'isComplete'        => 1,
                'status_size'       => 'SOFTDRINKS',
                'created_at'        => date("Y-m-d H:i:s"),
                'updated_at'        => date("Y-m-d H:i:s"),
            ],
            
        ];

        UCS::insert($ucs);
    }
}
