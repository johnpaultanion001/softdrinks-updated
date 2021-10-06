<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Customer;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $customers = [
            [
                'id'    => '1',
                'customer_code' => 'JP1',
                'customer_name' => 'John Paul',
                'area' => 'Antipolo City',
                'contact_number' => '09776668820',
                'current_balance' => '500',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
           
            [
                'id'    => '2',
                'customer_code' => 'JP2',
                'customer_name' => 'Customer Test',
                'area' => 'Test',
                'contact_number' => '09776668820',
                'current_balance' => '1000',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],

            [
                'id'    => '3',
                'customer_code' => 'JP3',
                'customer_name' => 'Customer Sample',
                'area' => 'Test',
                'contact_number' => '09776668820',
                'current_balance' => '400',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
        ];

        Customer::insert($customers);
    }
}
