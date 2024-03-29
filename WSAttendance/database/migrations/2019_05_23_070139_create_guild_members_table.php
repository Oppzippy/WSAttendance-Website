<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGuildMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('guild_members', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('guild_id');
            $table->bigInteger('user_id');
            $table->integer('permission_level')->default(0);
            $table->timestamps();

            $table->unique(['guild_id', 'user_id']);

            $table->foreign('guild_id')
                    ->references('id')
                    ->on('guilds')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');
            $table->foreign('user_id')
                    ->references('id')
                    ->on('users')
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
        Schema::dropIfExists('guild_members');
    }
}
