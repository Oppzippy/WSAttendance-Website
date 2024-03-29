<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttendanceLogDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attendance_log_data', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('log_id');
            $table->dateTime('time');
            $table->string('player');
            $table->string('key');
            $table->string('value');
            $table->timestamps();

            $table->foreign('log_id')
                    ->references('id')
                    ->on('attendance_log_meta')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('attendance_log_data');
    }
}
