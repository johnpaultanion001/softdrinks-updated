<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReceivingProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('receiving_products', function (Blueprint $table) {
            $table->id();
            $table->string('receiving_good_id');
            $table->string('product_id');
            
            
            $table->string('product_code');
            $table->string('category_id');
            $table->longText('description');
            
            $table->float('qty');
            $table->string('size_id');
            $table->date('expiration')->nullable();
            
            $table->float('unit_cost');
            $table->float('regular_discount');
            $table->float('hauling_discount');
            $table->float('additional_discount')->default(0);
            
            $table->float('price');
            $table->float('total_cost');
            
            $table->longText('product_remarks')->nullable();
           
            $table->string('location_id')->default(1);
            $table->string('supplier_id')->default(1);
            
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
        Schema::dropIfExists('receiving_products');
    }
}
