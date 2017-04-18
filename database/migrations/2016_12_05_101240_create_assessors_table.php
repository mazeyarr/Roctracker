<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->string('email');
            $table->integer('fk_college')->nullable(true);
            $table->string('team');
            $table->date('birthdate');
            $table->string('function');
            $table->string('profession');
            $table->string('trained_by')->nullable(true);
            $table->string('certified_by')->nullable(true);
            $table->integer('fk_teamleader')->nullable(true);
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
