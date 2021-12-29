<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesInventoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales_inventories', function (Blueprint $table) {
            $table->id();
            $table->string('receiving_good_id');
            
            $table->string('product_code');
            $table->string('category_id');
            $table->longText('description');

            $table->float('qty');
            $table->float('sold')->default(0);
            $table->float('orders')->default(0);
            $table->string('size_id');
            $table->date('expiration')->nullable();
            
            $table->float('unit_cost');
            $table->float('regular_discount');
            $table->float('hauling_discount');
            $table->float('price');
            $table->float('total_cost');
            
            $table->longText('product_remarks')->nullable();
           
            $table->string('supplier_id')->nullable();
            
            $table->boolean('isComplete')->default(false);
            $table->boolean('isRemove')->default(false);

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
        Schema::dropIfExists('sales_inventories');
    }
}
