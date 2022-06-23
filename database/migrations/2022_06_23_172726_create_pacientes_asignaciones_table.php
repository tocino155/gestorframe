<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePacientesAsignacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pacientes_asignaciones', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("id_paciente")->nullable();
            $table->unsignedBigInteger("id_especialidad")->nullable();
            $table->unsignedBigInteger("id_medico")->nullable();
            $table->string("observaciones")->nullable();
            $table->unsignedBigInteger("id_procedimiento")->nullable();
            $table->foreign("id_paciente")->references("id")->on("pacientes");
            $table->foreign("id_especialidad")->references("id")->on("cat_especialidades")->onDelete("set null");
            $table->foreign("id_medico")->references("id")->on("medicos")->onDelete("set null");
            $table->foreign("id_procedimiento")->references("id")->on("cat_procedimiento_costo")->onDelete("set null");
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
        Schema::dropIfExists('pacientes_asignaciones');
    }
}
