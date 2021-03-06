<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProproesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proproes', function (Blueprint $table) {
            $table->integer('p_id');
            $table->integer('pro_id');
            $table->string('pp_value')->index();
            $table->string('pp_note')->nullable();
            $keys = array('p_id','pro_id');
            $table->primary($keys);
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
        Schema::dropIfExists('proproes');
    }
}
