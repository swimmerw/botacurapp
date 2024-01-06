<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservacionProgramaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservacion_programa', function (Blueprint $table) {
            $table->Increments('id');
            $table->unsignedInteger('programa_id');
            $table->foreign('programa_id')->references('id')->on('programas')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedInteger('reserva_id');
            $table->foreign('reserva_id')->references('id')->on('reservas')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('reservacion_programa');
    }
}
