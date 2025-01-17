<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('operadores', function (Blueprint $table) {
            $table->id();
            $table->string('nombreoperador');
            $table->string('fechanacimiento');
            $table->string('nolicencia');
            $table->string('tipolicencia');
            $table->string('fechavencimientomedico');
            $table->string('fechavencimientolicencia');
            $table->string('cliente');
            $table->string('licencia');
            $table->string('curso');
            $table->string('examenmedico');
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
        Schema::dropIfExists('operadores');
    }
};
