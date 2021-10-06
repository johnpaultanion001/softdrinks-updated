<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->string('salesinvoice_id');
            $table->string('order_number');
            $table->string('inventory_id');
            $table->string('user_id');
            $table->integer('purchase_qty');
            $table->float('profit');
            $table->float('total');
            $table->integer('isRemove')->default(0);
            $table->integer('status')->default(0);
            $table->string('customer_id');
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
        Schema::dropIfExists('sales');
    }
}
