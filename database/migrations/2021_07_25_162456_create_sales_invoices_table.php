<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales_invoices', function (Blueprint $table) {
            $table->id();
            $table->string('salesinvoice_id');
            $table->string('user_id');
            $table->string('doc_no')->nullable();
            $table->date('entry_date');
            $table->longText('remarks')->nullable();
            $table->string('customer_id');
            $table->float('subtotal');
            $table->float('total_discount');
            $table->float('total_amount');
            $table->float('total_return')->nullable();;
            $table->float('prev_bal')->default(0);
            $table->float('total_inv_amt');
            $table->float('cash');
            $table->float('change');
            $table->float('new_bal');
            $table->integer('isVoid')->default(0);
    
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
        Schema::dropIfExists('sales_invoices');
    }
}
