<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->id('cli_id');
            $table->string('cli_nombre',150);
            $table->char('cli_celular',9);
            $table->char('cli_calificacion',1)->default('B');//B = bueno |M = Malo   |R = regular
            $table->bigInteger('emp_id')->unsigned();
            $table->bigInteger('usu_id')->unsigned()->unique()->nullable();
            $table->foreign('emp_id')->references('emp_id')->on('empresas');
            $table->foreign('usu_id')->references('id')->on('usuarios');
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
        Schema::dropIfExists('clientes');
    }
}
