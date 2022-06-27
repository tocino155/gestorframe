<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTurnosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('turnos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("id_paciente")->nullable();
            $table->unsignedBigInteger("id_area")->nullable();
            $table->date("fecha")->nullable();
            $table->string("estado")->nullable();
            $table->foreign("id_paciente")->references("id")->on("pacientes")->onDelete("set null");
            $table->foreign("id_area")->references("id")->on("cat_areas")->onDelete("set null");
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
        Schema::dropIfExists('turnos');
    }
}
