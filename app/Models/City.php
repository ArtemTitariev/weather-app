<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'name', 'lat', 'lon'];

    protected $casts = [
        'id' => 'int',
        'lat' => 'double',
        'lon' => 'double',
    ];
}
