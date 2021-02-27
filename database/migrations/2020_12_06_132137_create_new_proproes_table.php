<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewProproesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('new_proproes', function (Blueprint $table) {
            $table->integer('p_id')->unsigned()->index();
            $table->integer('color_id')->unsigned()->index();
            $table->integer('size_id')->unsigned()->index();
            $table->string('note')->nullable();
            $table->timestamps();
            $keys = array('p_id','color_id','size_id');
            $table->primary($keys);

            $table->foreign('p_id')->references('id')->on('products');
            $table->foreign('color_id')->references('id')->on('colors');
            $table->foreign('size_id')->references('id')->on('sizes');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('new_proproes');
    }
}
