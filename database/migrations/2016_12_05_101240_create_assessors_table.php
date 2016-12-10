<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssessorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assessors', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('fk_college');
            $table->string('team');
            $table->date('birthdate');
            $table->string('function');
            $table->string('trained_by');
            $table->string('certified_by');
            $table->string('fk_teamleader');
            $table->tinyInteger('status');
            $table->integer('fk_exams')->nullable(true);
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
        Schema::dropIfExists('assessors');
    }
}
