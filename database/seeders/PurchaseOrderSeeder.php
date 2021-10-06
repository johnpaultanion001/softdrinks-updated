<?php

namespace Database\Seeders;
use App\Models\PurchaseOrder;

use Illuminate\Database\Seeder;

class PurchaseOrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $purchaseorder = [
            [
                'id'    => '1',
                'user_id' => '1',
                'purchase_order_number' => '1',
                'supplier_id' => '1',
                'total_purchased_order' => '93200',
                'total_profit' => '12900',
                'total_price' => '106100',
                'total_orders' => '5',
                'remarks' => 'Sample',
                'name_of_a_driver' => 'John Paul Tanion',
                'plate_number' => 'ABC 123',

                'doc_no' => '123',
                'entry_date' => date("Y-m-d H:i:s"),
                'po_no' => '123',
                'po_date' => date("Y-m-d H:i:s"),
                'location_id' => '1',
                'reference' => 'sample',

                'trade_discount' => '0',
                'terms_discount' => '0',
                'isRemove' => 1,
 

                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
            
        ];

        PurchaseOrder::insert($purchaseorder);
    }
}
