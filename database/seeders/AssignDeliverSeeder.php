<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AssignDeliver;

class AssignDeliverSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $deliveries = [
            [
                'title'      => 'Tricycle 1',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
            [
                'title'      => 'Tricycle 2',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
            [
                'title'      => 'Truck 1',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
            [
                'title'      => 'Truck 2',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
           
        ];

        AssignDeliver::insert($deliveries);
    }
}
