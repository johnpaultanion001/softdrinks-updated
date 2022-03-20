<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReceivingGoodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('receiving_goods', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('supplier_id');
            $table->string('location_id');

            $table->longText('doc_no')->nullable();
            $table->date('entry_date');
            $table->longText('po_no')->nullable();
            $table->date('po_date')->nullable();
            

            $table->string('plate_number');
            $table->string('name_of_a_driver');
            $table->float('trade_discount')->nullable();
            $table->float('terms_discount')->nullable();

            $table->longText('remarks')->nullable();
            $table->string('reference')->nullable();
            
            $table->float('total_orders');
            $table->float('over_all_cost');
            $table->float('cash1')->nullable();

            
            $table->boolean('isVoid')->default(false);
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
        Schema::dropIfExists('receiving_goods');
    }
}
