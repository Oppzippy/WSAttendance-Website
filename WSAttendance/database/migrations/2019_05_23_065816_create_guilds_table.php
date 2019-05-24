<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGuildsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('guilds', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('owner_id');
            $table->string('name')->unique();
            $table->string('visibility')->default('unlisted');
            $table->timestamps();

            $table->foreign('owner_id')
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
        Schema::dropIfExists('guilds');
    }
}
