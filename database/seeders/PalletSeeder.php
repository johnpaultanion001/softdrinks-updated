<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pallet;

class PalletSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pallets = [
            [
                'id'       => '1',
                'title'    => 'BIG PALLET',
                'PRICE'    => '2800',
                'stock'    => '5',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
            [
                'id'       => '2',
                'title'    => 'SMALL PALLET',
                'PRICE'    => '2400',
                'stock'    => '5',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
        
        ];
        Pallet::insert($pallets);
    }
}
