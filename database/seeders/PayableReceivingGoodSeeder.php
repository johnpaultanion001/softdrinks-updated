<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PayableReceivingGood;

class PayableReceivingGoodSeeder extends Seeder
{
    public function run()
    {
        $payables = [
            [
                'supplier_id'       => '1',
                'receiving_good_id' => '1',
                'payable_amount'    => '100',
                'created_at'        => date("Y-m-d H:i:s"),
                'updated_at'        => date("Y-m-d H:i:s"),
            ],
        ];

        PayableReceivingGood::insert($payables);

    }
}
