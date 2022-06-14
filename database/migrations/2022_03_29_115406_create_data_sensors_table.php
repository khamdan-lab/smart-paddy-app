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
            $table->String('light_intensity');
            $table->String('wind_speed');
            $table->String('rainfall');
            $table->float('latitude', 5,2);
            $table->float('longitude', 5,2);
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
