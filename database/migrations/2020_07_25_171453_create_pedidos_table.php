<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePedidosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pedidos', function (Blueprint $table) {
            $table->id('ped_id');
            $table->string('ped_entrada',100);
            $table->string('ped_estado',15)->default('Pendiente'); //Pendiente | En camino | Entregado | Cancelado 
            $table->string('ped_direccion',150);
            $table->string('ped_referencia')->nullable();
            $table->decimal('ped_lat',15,12)->nullable();
            $table->decimal('ped_log',15,12)->nullable();
            $table->bigInteger('cli_id')->unsigned();
            $table->bigInteger('rep_id')->unsigned()->nullable();
            $table->bigInteger('adm_id')->unsigned()->nullable();
            $table->foreign('cli_id')->references('cli_id')->on('clientes');
            $table->foreign('rep_id')->references('rep_id')->on('repartidors');
            $table->foreign('adm_id')->references('adm_id')->on('administradors');

            $table->timestamps();//Usaremos esto para las fechas de pedido
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pedidos');
    }
}
