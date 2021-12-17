<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('salesinvoice_id');
            $table->string('order_number');
            $table->string('product_id');
            $table->float('product_price');
            $table->float('purchase_qty');

            $table->float('profit');
            $table->float('total');
            $table->integer('status')->default(0);
            $table->string('customer_id')->default(0);

            $table->string('pricetype_id');
            $table->float('discounted');
            $table->float('total_cost');
            $table->float('total_amount_receipt');
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
        Schema::dropIfExists('orders');
    }
}
