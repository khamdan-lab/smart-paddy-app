<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DataSensor;
use carbon\Carbon;
use DB;

class DataSensorController extends Controller
{
    public function index()
    {
        $date = Carbon::now()->toDateString();

        $temp           = DataSensor::whereDate('created_at', $date)->pluck('temperature');
        // return $temp;
        $humd           = DataSensor::whereDate('created_at', $date)->pluck('humidity');
        $soilPH         = DataSensor::whereDate('created_at', $date)->pluck('ph');
        $waterPH        = DataSensor::whereDate('created_at', $date)->pluck('ph_water');
        $soilMoisture   = DataSensor::whereDate('created_at', $date)->pluck('soil_moisture');
        $lightIntensity = DataSensor::whereDate('created_at', $date)->pluck('light_intensity');
        $windSpeed      = DataSensor::whereDate('created_at', $date)->pluck('wind_speed');
        $rainfall       = DataSensor::whereDate('created_at', $date)->pluck('rainfall');
        $now_day        = Carbon::now();
        $date_now       = DataSensor::whereDate('created_at', $date)->pluck('created_at');
        $time  = array();
        for ($i=0; $i < count($date_now); $i++) {
             $hour = Carbon::parse($date_now[$i])->format('H:i');
             array_push($time, $hour);
        }

        return view('main_dashboard', compact(['temp','humd','soilPH', 'waterPH' ,'soilMoisture','lightIntensity','windSpeed', 'rainfall', 'time']));

    }

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

    public function filterHari(Request $request){

        $date = $request->date;

        $temp           = DataSensor::whereDate('created_at', $date)->pluck('temperature');
        $humd           = DataSensor::whereDate('created_at', $date)->pluck('humidity');
        $soilPH         = DataSensor::whereDate('created_at', $date)->pluck('ph');
        $waterPH        = DataSensor::whereDate('created_at', $date)->pluck('ph_water');
        $soilMoisture   = DataSensor::whereDate('created_at', $date)->pluck('soil_moisture');
        $lightIntensity = DataSensor::whereDate('created_at', $date)->pluck('light_intensity');
        $windSpeed      = DataSensor::whereDate('created_at', $date)->pluck('wind_speed');
        $rainfall       = DataSensor::whereDate('created_at', $date)->pluck('rainfall');
        $now_day        = Carbon::now();
        $date_now       = DataSensor::whereDate('created_at', $date)->pluck('created_at');
        $time  = array();
        for ($i=0; $i < count($date_now); $i++) {
             $hour = Carbon::parse($date_now[$i])->format('H:i');
             array_push($time, $hour);
        }

        return view('grafik.main', compact(['temp','humd','soilPH','waterPH','soilMoisture','lightIntensity','windSpeed','rainfall','time']));

    }

    public function filterBulan( Request $request){
        $month  = $request->month;
        $year   = $request->year;

        $temp           = DataSensor::whereMonth('created_at', $month)->whereYear('created_at', $year)->pluck('temperature');
        $humd           = DataSensor::whereMonth('created_at', $month)->whereYear('created_at', $year)->pluck('humidity');
        $soilPH         = DataSensor::whereMonth('created_at', $month)->whereYear('created_at', $year)->pluck('ph');
        $waterPH        = DataSensor::whereMonth('created_at', $month)->whereYear('created_at', $year)->pluck('ph_water');
        $soilMoisture   = DataSensor::whereMonth('created_at', $month)->whereYear('created_at', $year)->pluck('soil_moisture');
        $lightIntensity = DataSensor::whereMonth('created_at', $month)->whereYear('created_at', $year)->pluck('light_intensity');
        $windSpeed      = DataSensor::whereMonth('created_at', $month)->whereYear('created_at', $year)->pluck('wind_speed');
        $rainfall       = DataSensor::whereMonth('created_at', $month)->whereYear('created_at', $year)->pluck('rainfall');
        $date           = DataSensor::whereMonth('created_at', $month)->whereYear('created_at', $year)->pluck('created_at');

        $time  = array();
        for ($i=0; $i < count($date); $i++) {
             $hour = Carbon::parse($date[$i])->format('H:i');
             array_push($time, $hour);
        }

        return view('grafik.main', compact(['temp','humd','soilPH','waterPH','soilMoisture','lightIntensity','windSpeed','rainfall','time']));
    }

}
