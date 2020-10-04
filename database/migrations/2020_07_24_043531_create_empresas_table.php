<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpresasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empresas', function (Blueprint $table) {
            $table->id('emp_id');
            $table->string('emp_nombre',150)->unique();
            $table->string('emp_ruc',11)->unique();
            $table->string('emp_log',150)->nullable();
            $table->string('emp_correo',100)->unique();
            $table->char('emp_celular',9)->unique();
            $table->string('emp_direccion',150)->nullable();
            $table->string('emp_facebook',100)->nullable();
            $table->string('emp_instagram',100)->nullable();
            $table->string('emp_twitter',100)->nullable();
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
        Schema::dropIfExists('empresas');
    }
}
