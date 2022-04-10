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

}
