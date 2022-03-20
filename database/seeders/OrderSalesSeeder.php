<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\OrderSales;

class OrderSalesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ordersales = [
            [
                'id'    => '1',
                'order_number_id' => '100001',
                'total_profit' => '5340',
                'total_sales' => '46750',
                'total_cost' => '31410',
                'customer_id' => '1',
                'total_qty' => '65',
                'subtotal' => '46750',
                'total' => '46750',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
        
           
          
        ];

        OrderSales::insert($ordersales);
    }
}
