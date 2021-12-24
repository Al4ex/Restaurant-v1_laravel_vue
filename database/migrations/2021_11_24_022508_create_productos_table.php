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
            $table->id('prod_id');
            $table->string('prod_name', 100);
            $table->integer('prod_price')->unsigned();
            $table->string('prod_description', 300);
            $table->integer('prod_categoria')->unsigned();
            $table->tinyInteger('prod_visible');
            $table->tinyInteger('prod_delete');
            $table->text('prod_image');
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
