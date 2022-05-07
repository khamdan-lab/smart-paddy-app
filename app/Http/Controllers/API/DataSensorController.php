<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DataSensor;

class DataSensorController extends Controller
{
    public function getSensor()
    {
        $data_sensor = DataSensor::latest()->get();
        return $data_sensor;
    }

    public function store(Request $request){

        $data = array(
            "device_id"         => $request->device_id,
            "temperature"       => $request->temperature,
            "humidity"          => $request->humidity,
            "soil_moisture"     => $request->soil_moisture,
            "ph"                => $request->ph,
            "light_intensity"   => $request->light_intensity,
            "wind_speed"        => $request->wind_speed,
            "wind_direction"    => $request->wind_direction
        );

        DataSensor::insert($data);

    }

}
