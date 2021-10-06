<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLocationTransfersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('location_transfers', function (Blueprint $table) {
            $table->id();
            $table->date('entry_date');
            $table->string('reference')->nullable();
            $table->date('reference_date')->nullable();
            $table->string('location_from');
            $table->string('location_to');
            $table->string('transfer_count')->nullable();
            $table->string('prepared_by')->nullable();
            $table->longText('remarks')->nullable();
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
        Schema::dropIfExists('location_transfers');
    }
}
