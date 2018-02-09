<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersChat extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_sala', function (Blueprint $table) {
            $table->integer('id_usuario')->unsigned();
            $table->foreign('id_usuario')->references('id_usuario')
            ->on('users')->onDelete('cascade');

            $table->integer('id_sala')->unsigned();
            $table->foreign('id_sala')->references('id_sala')
            ->on('sala')->onDelete('cascade');

            $table->boolean('is_admin')->default('false');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users_sala');
    }
}
