<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateScheduleEmailTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedule_email_tasks', function (Blueprint $table) {
            $table->increments('id');
            $table->dateTime('at_date')->nullable(true);
            $table->string('table');
            $table->text('to');
            $table->integer('fk_mail_texts');
            $table->boolean('done')->default(0);
            $table->boolean('repeat')->default(0);
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
        Schema::dropIfExists('schedule_email_tasks');
    }
}
