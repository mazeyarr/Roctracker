<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTiCsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /** This is the mid table for teamleaders in colleges*/
        Schema::create('ti_cs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('fk_teamleader');
            $table->integer('fk_college');
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
        Schema::dropIfExists('ti_cs');
    }
}
