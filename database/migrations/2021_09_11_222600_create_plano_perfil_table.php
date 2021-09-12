<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlanoPerfilTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('perfil_plano', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('plano_id');
            $table->unsignedInteger('perfil_id');

            $table->foreign('plano_id')->references('id')->on('planos')->onDelete('CASCADE');
            $table->foreign('perfil_id')->references('id')->on('perfils')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('perfil_plano');
    }
}
