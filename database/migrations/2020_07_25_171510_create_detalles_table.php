<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetallesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalles', function (Blueprint $table) {
            $table->unsignedDecimal('det_precio', 7, 2)->nullable();
            $table->unsignedDecimal('det_descuento', 7, 2)->nullable();
            $table->unsignedDecimal('det_total', 7, 2)->nullable();
            $table->integer('det_cantidad')->default(1);
            $table->bigInteger('ped_id')->unsigned();
            $table->bigInteger('pro_id')->unsigned();
            $table->primary(['ped_id','pro_id']);
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
        Schema::dropIfExists('detalles');
    }
}
