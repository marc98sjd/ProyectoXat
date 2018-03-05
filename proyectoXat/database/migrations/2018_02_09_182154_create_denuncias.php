<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDenuncias extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create('denuncias', function (Blueprint $table) {
            $table->increments('id');

            $table->string('titulo');
            $table->string('descripcion');
            $table->string('imagen')->nullable();
            $table->string('ubicacion');
            $table->string('comentario')->nullable();
            $table->integer('id_usuario')->unsigned();
            $table->foreign('id_usuario')->references('id')
            ->on('users')->onDelete('cascade');
            
            $table->timestamps();   
        });

        Schema::create('noticias', function (Blueprint $table) {
            $table->increments('id');
            $table->string('titulo');
            $table->string('descripcion');
            $table->string('imagen')->nullable();
            $table->string('comentario')->nullable();
            $table->string('categoria');
            $table->integer('id_usuario')->unsigned();
            $table->foreign('id_usuario')->references('id')
            ->on('users')->onDelete('cascade');
            $table->boolean('importante')->default(0);
            $table->timestamp('fechaImportante')->nullable();
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
        Schema::dropIfExists('denuncias');
        Schema::dropIfExists('noticias');
    }
}