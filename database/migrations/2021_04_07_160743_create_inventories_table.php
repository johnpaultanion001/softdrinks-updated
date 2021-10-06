<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


class CreateInventoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
 

    public function up()
    {
        Schema::create('inventories', function (Blueprint $table) {
            $table->id();
            $table->string('category_id');
            $table->string('purchase_order_number_id');
            
            $table->string('product_code');
            $table->longText('long_description');
            $table->longText('short_description');

            $table->integer('stock');
            $table->integer('qty');
            $table->integer('pqty');
            $table->integer('sold')->default(0);
            $table->integer('orders')->default(0);
            $table->integer('add_qty')->default(0);
            
            $table->string('size_id');
            
            $table->date('expiration');
            
            $table->float('purchase_amount', 8, 2);
            $table->float('profit', 8, 2);
            $table->float('price', 8, 2);

            $table->float('total_amount_purchase', 8, 2);
            $table->float('total_profit', 8, 2);
            $table->float('total_price', 8, 2);
            
           
            $table->longText('product_remarks')->nullable();
            

            $table->string('location_id')->default(2);
            $table->integer('isRemove')->default(0);
            $table->integer('isSame')->default(0);
            
            $table->string('product_id')->unique();
            $table->string('supplier_id');
            $table->float('ucs_size', 8, 2);

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
        Schema::dropIfExists('inventories');
    }
}
