<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Weather extends Model
{
    use HasFactory;

    protected $fillable = [
        'int',
        'date',
        'city_id',
        'temperature',
        'wind_speed',
        'clouds',
        'humidity',
        'pressure',
        'icon',
    ];

    protected $casts = [
        'id' => 'int',
        'date' => 'date',
        'city_id' => 'int',
        'temperature' => 'int',
        'wind_speed' => 'float',
        'clouds' => 'int',
        'humidity' => 'int',
        'pressure' => 'int',
    ];
}
