<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReturnedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('returneds', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->integer('purchase_order_number_id')->unique();
            $table->integer('total_orders_returned');
            $table->float('total_case_return', 8, 2);
            $table->float('total_deposit', 8, 2);
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
        Schema::dropIfExists('returneds');
    }
}
