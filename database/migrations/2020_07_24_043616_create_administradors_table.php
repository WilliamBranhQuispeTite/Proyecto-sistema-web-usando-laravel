<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdministradorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('administradors', function (Blueprint $table) {
            $table->id('adm_id');
            $table->string('adm_nombre',150);
            $table->char('adm_dni',8);
            $table->char('adm_celular',9);
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
        Schema::dropIfExists('administradors');
    }
}
