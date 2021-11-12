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
                'name' => 'Coca-Cola Antipolo DC 502',
                'address' => 'Sumulong Highway Mayamot Antipolo Rizal',
                'contact_number' => '6322895946',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
                
            ],
            [
                'name' => 'Coca-Cola Antipolo DC STILLS',
                'address' => 'Sumulong Highway Mayamot Antipolo Rizal',
                'contact_number' => '6322895946',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
            [
                'name' => 'Coca-Cola Sta. Rosa MAIN',
                'address' => 'Pulong Sta. Cruz Sta. Rosa Laguna',
                'contact_number' => '0',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
            [
                'name' => 'Southern Fillers Corporation',
                'address' => '0534 National Road, Brgy. Calumpang Binangonan Rizal',
                'contact_number' => '9176521717',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
            [
                'name' => 'Jewel & Nickle Pritil',
                'address' => '001 Sta. Ursula Str. Pritil Binangonan Rizal',
                'contact_number' => '9300708326',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
            [
                'name' => 'Eddie & Kristine',
                'address' => 'Calumpang Binangonan Rizal',
                'contact_number' => '9999366184',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
        ];

        Supplier::insert($suppliers);
    }
}
