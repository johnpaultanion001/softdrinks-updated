<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePendingReturnedProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pending_returned_products', function (Blueprint $table) {
            $table->id();
            $table->integer('purchase_order_number_id');
            $table->text('product_id');
            $table->integer('qty');
            $table->float('unit_price', 8, 2);
            $table->float('amount', 8, 2);
            $table->string('status_id');
            $table->text('remarks')->nullable();
            $table->integer('isRemove')->default(0);
           
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
        Schema::dropIfExists('pending_returned_products');
    }
}
