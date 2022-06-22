<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePasientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pasientes', function (Blueprint $table) {
            $table->id();
            $table->string("nombre")->nullable();
            $table->string("apellido_pat")->nullable();
            $table->string("apellido_mat")->nullable();
            $table->date("fecha_nacimiento")->nullable();
            $table->string("domicilio")->nullable();
            $table->BigInteger("id_pais")->nullable();
            $table->BigInteger("telefono")->nullable();
            $table->string("correo")->nullable();
            $table->string("estado")->nullable();
            $table->string("delegacion")->nullable();
            $table->string("colonia")->nullable();
            $table->string("cp")->nullable();
            $table->string("observaciones")->nullable();
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
        Schema::dropIfExists('pasientes');
    }
}
