<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCatAreasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cat_areas', function (Blueprint $table) {
            $table->id();
            $table->string("Area")->nullable();
            $table->unsignedBigInteger("Especialidad")->nullable();
            $table->foreign("Especialidad")->references("id")->on("cat_especialidades")->onDelete("set null");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cat_areas');
    }
}
