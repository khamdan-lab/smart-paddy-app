<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataSensorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_sensors', function (Blueprint $table) {
            $table->id();
            $table->String('device_id');
            $table->float('temperature', 5,2);
            $table->float('humidity', 5,2);
            $table->integer('soil_moisture');
            $table->float('ph', 5,2);
            $table->float('ph_water', 5,2);
            $table->integer('light_intensity');
            $table->float('wind_speed');
            $table->float('rainfall');
            $table->double('latitude', 5,6);
            $table->double('longitude', 5,6);
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
        Schema::dropIfExists('data_sensors');
    }
}
