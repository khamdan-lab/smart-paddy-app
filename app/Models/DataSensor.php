<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataSensor extends Model
{
    use HasFactory;

    protected $table    = "data_sensors";
    protected $fillable = [
        'temperature',
        'humidity',
        'soil_moisture',
        'ph',
        'light_intensity',
        'wind_speed',
        'wind_direction'
    ];

}
