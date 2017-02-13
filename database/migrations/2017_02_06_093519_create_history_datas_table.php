<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHistoryDatasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('history_datas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('year');
            $table->text('assessor_data');
            $table->integer('actieve_assessors');
            $table->integer('c_assessors');
            $table->integer('c_colleges');
            $table->integer('c_teamleaders');
            $table->integer('c_teamleaders_in_colleges');
            $table->boolean('year_checked');
            $table->text('log');
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
        Schema::dropIfExists('history_datas');
    }
}
