<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttendanceLogMetaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attendance_log_meta', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('guild_id');
            $table->bigInteger('uploader_id');
            $table->dateTime('start_time');
            $table->dateTime('end_time');
            $table->timestamps();

            $table->index('guild_id');
            $table->foreign('guild_id')
                    ->references('id')
                    ->on('guilds')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');
            $table->foreign('uploader_id')
                    ->references('id')
                    ->on('users')
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
        Schema::dropIfExists('attendance_log_meta');
    }
}
