<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesPalletsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales_pallets', function (Blueprint $table) {
            $table->id();
            $table->string('salesinvoice_id');
            $table->string('pallet_id');
            $table->string('type');
            $table->float('qty');
            $table->float('unit_price');
            $table->float('amount');
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
        Schema::dropIfExists('sales_pallets');
    }
}
