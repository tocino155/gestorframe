<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medicos', function (Blueprint $table) {
            $table->id();
            $table->string("nombre")->nullable();
            $table->string("apellido_pat")->nullable();
            $table->string("apellido_mat")->nullable();
            $table->unsignedBigInteger("id_especialidad")->nullable();
            $table->string("dia_inicio")->nullable();
            $table->string("dia_final")->nullable();
            $table->time("hora_inicio")->nullable();
            $table->time("hora_final")->nullable();
            $table->foreign("id_especialidad")->references("ID")->on("cat_especialidades")->onDelete("set null");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('medicos');
    }
}
