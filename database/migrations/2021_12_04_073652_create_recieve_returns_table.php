<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecieveReturnsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recieve_returns', function (Blueprint $table) {
            $table->id();
            $table->string('receiving_good_id');
            $table->string('product_id');
            $table->float('return_qty');
            $table->float('unit_price');
            $table->float('amount');
            $table->string('status_id');
            $table->string('type_of_return')->default('EMPTY');
            $table->string('remarks')->nullable();
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
        Schema::dropIfExists('recieve_returns');
    }
}
