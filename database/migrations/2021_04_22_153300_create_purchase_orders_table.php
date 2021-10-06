<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchaseOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_orders', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->integer('purchase_order_number')->unique();
            $table->string('supplier_id');
            $table->float('total_purchased_order');
            $table->float('total_profit');
            $table->float('total_price');
            $table->longText('remarks')->nullable();
            $table->string('plate_number');
            $table->string('name_of_a_driver');
            $table->integer('isReturn')->default(0);
            $table->integer('isRemove')->default(0);
            $table->integer('total_orders');
            
            $table->longText('doc_no')->nullable();
            $table->date('entry_date');
            $table->longText('po_no')->nullable();
            $table->date('po_date');

            $table->string('location_id');
            $table->string('reference')->nullable();

            $table->float('trade_discount')->nullable();
            $table->float('terms_discount')->nullable();

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
        Schema::dropIfExists('purchase_orders');
    }
}
