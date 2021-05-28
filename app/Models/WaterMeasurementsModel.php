<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WaterMeasurementsModel extends Model
{
    use HasFactory;

    protected $table = "watermeasurements";

    protected $fillable = [
        'NO3',
        'NO2',
        'GH',
        'KH',
        'PH',
        'Cl2'
    ];
}
