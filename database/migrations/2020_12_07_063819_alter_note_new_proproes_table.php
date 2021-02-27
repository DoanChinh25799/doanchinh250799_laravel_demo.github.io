<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterNoteNewProproesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('new_proproes', function (Blueprint $table) {
            $table->string('size_name')->after('size_id');
            $table->string('color_name')->after('size_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('new_proproes', function (Blueprint $table) {
            $table->dropColumn('size_name');
            $table->dropColumn('color_name');
        });
    }
}
