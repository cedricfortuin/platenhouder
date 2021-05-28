<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWatermeasurementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('watermeasurements', function (Blueprint $table) {
            $table->id();
            $table->integer('NO3');
            $table->integer('NO2');
            $table->integer('gH');
            $table->integer('kH');
            $table->float('pH');
            $table->float('Cl2');
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
        Schema::dropIfExists('watermeasurements');
    }
}
