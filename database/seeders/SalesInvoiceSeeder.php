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
                'id'    => '1',
                'salesinvoice_id' => '100001',
                'doc_no' => '1111',
                'entry_date' => date("Y-m-d"),
                'remarks' => 'Test',
                'customer_id' => '1',

                'subtotal' => '46750',
                'total_discount' => '0',
                'total_amount' => '46750',
                'total_return' => '0',
                'prev_bal' => '0',

                'total_inv_amt' => '46750',
                'cash' => '46750',
                'change' => '0',
                'new_bal' => '46750',
                'user_id' => '1',
        
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
        
           
          
        ];

        SalesInvoice::insert($salesinvoice);
    }
}
