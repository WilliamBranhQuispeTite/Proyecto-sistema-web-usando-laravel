<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRepartidorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('repartidors', function (Blueprint $table) {
            $table->id('rep_id');
            $table->string('rep_nombre',150);
            $table->char('rep_dni',8);
            $table->char('rep_celular',9);
            $table->char('rep_dispo',10)->default('Disponible');//Disponible | Ocupado  | Ausente
            $table->bigInteger('emp_id')->unsigned();
            $table->bigInteger('usu_id')->unsigned()->unique();
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
        Schema::dropIfExists('repartidors');
    }
}
