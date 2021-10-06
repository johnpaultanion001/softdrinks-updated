<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_sales', function (Blueprint $table) {
            $table->id();
            $table->string('order_number_id');
            $table->float('total_profit');
            $table->float('total_sales');
            $table->float('total_cost');
            $table->string('customer_id');
            $table->integer('total_qty');
            $table->float('subtotal');
            $table->float('total');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_sales');
    }
}
