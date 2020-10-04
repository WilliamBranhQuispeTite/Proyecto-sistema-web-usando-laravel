<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->id('pro_id');
            $table->string('pro_nombre',100);
            $table->text('pro_descripcion')->nullable();
            $table->integer('pro_stock')->default(1);
            $table->unsignedDecimal('pro_precio', 7, 2)->nullable();
            $table->unsignedDecimal('pro_promo', 7, 2)->nullable(); //precio con descuento por promocion
            $table->string('pro_imagen');
            $table->bigInteger('cat_id')->unsigned();                         
            $table->foreign('cat_id')->references('cat_id')->on('categorias');
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
        Schema::dropIfExists('productos');
    }
}
