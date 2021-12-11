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
                
                'salesinvoice_id' => '100001',
                'doc_no' => '1111',
                'entry_date' => date("Y-m-d"),
                'remarks' => 'Test',
                'customer_id' => '1',

                'subtotal' => '7593.50',
                'total_discount' => '0',
                'total_amount' => '7593.50',
                'total_return' => '0',
                'prev_bal' => '0',

                'total_inv_amt' => '7593.50',
                'cash' => '7593.50',
                'change' => '0',
                'new_bal' => '7593.50',
                'user_id' => '1',
        
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
            [
               
                'salesinvoice_id' => '100002',
                'doc_no' => '1111',
                'entry_date' => date("Y-m-d"),
                'remarks' => 'Test',
                'customer_id' => '1',

                'subtotal' => '7593.50',
                'total_discount' => '0',
                'total_amount' => '7593.50',
                'total_return' => '0',
                'prev_bal' => '0',

                'total_inv_amt' => '7593.50',
                'cash' => '7593.50',
                'change' => '0',
                'new_bal' => '7593.50',
                'user_id' => '1',
        
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
            [
                'salesinvoice_id' => '100003',
                'doc_no' => '1111',
                'entry_date' => date("Y-m-d"),
                'remarks' => 'Test',
                'customer_id' => '1',

                'subtotal' => '7593.50',
                'total_discount' => '0',
                'total_amount' => '7593.50',
                'total_return' => '0',
                'prev_bal' => '0',

                'total_inv_amt' => '7593.50',
                'cash' => '7593.50',
                'change' => '0',
                'new_bal' => '7593.50',
                'user_id' => '1',
        
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
        
           
          
        ];

        SalesInvoice::insert($salesinvoice);
    }
}
