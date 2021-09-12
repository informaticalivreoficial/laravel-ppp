<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePerfilPermissoesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('perfil_permissoes', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('permissoes_id');
            $table->unsignedInteger('perfil_id');

            $table->foreign('permissoes_id')->references('id')->on('permissoes')->onDelete('CASCADE');
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
        Schema::dropIfExists('perfil_permissoes');
    }
}
