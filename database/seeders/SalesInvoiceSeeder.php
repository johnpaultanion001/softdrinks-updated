<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SalesInvoice;

class SalesInvoiceSeeder extends Seeder
{
   
    public function run()
    {
        $salesinvoice = [
            [
                
                'salesinvoice_id'       => '1001',
                'doc_no'                => '1111',
                'entry_date'            => date("Y-m-d"),
                'remarks'               => 'Test',
                'customer_id'           => '1',
                'deliver_id'            => '1',

                'subtotal'              => '5980',
                'total_discount'        => '0',
                'total_amount'          => '5980',
                'total_return'          => '0',
                'prev_bal'              => '0',

                'total_inv_amt'         => '5980',
                'cash'                  => '5980',
                'change'                => '0',
                'new_bal'               => '5980',
                'user_id'               => '1',
        
                'created_at'            => date("Y-m-d H:i:s"),
                'updated_at'            => date("Y-m-d H:i:s"),
            ],
            [
                
                'salesinvoice_id'       => '1002',
                'doc_no'                => '1111',
                'entry_date'            => date("Y-m-d"),
                'remarks'               => 'Test',
                'customer_id'           => '1',
                'deliver_id'            => '2',

                'subtotal'              => '5980',
                'total_discount'        => '0',
                'total_amount'          => '5980',
                'total_return'          => '0',
                'prev_bal'              => '0',

                'total_inv_amt'         => '5980',
                'cash'                  => '5980',
                'change'                => '0',
                'new_bal'               => '5980',
                'user_id'               => '1',
        
                'created_at'            => date("Y-m-d H:i:s"),
                'updated_at'            => date("Y-m-d H:i:s"),
            ],
            [
                
                'salesinvoice_id'       => '1003',
                'doc_no'                => '1111',
                'entry_date'            => date("Y-m-d"),
                'remarks'               => 'Test',
                'customer_id'           => '1',
                'deliver_id'            => '3',

                'subtotal'              => '5980',
                'total_discount'        => '0',
                'total_amount'          => '5980',
                'total_return'          => '0',
                'prev_bal'              => '0',

                'total_inv_amt'         => '5980',
                'cash'                  => '5980',
                'change'                => '0',
                'new_bal'               => '5980',
                'user_id'               => '1',
        
                'created_at'            => date("Y-m-d H:i:s"),
                'updated_at'            => date("Y-m-d H:i:s"),
            ],
           
          
        ];

        SalesInvoice::insert($salesinvoice);
    }
}
