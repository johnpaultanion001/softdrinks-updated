<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUCSTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('u_c_s', function (Blueprint $table) {
            $table->id();
            $table->string('receiving_good_id');
            $table->string('product_id');
            $table->float('ucs_size', 8, 2);
            $table->float('ucs', 8, 2)->default(0);
            $table->float('qty', 8, 2);
            $table->boolean('isRemove')->default(false);
            $table->boolean('isComplete')->default(false);
            $table->string('status_size');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
            $table->boolean('isHide')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('u_c_s');
    }
}
