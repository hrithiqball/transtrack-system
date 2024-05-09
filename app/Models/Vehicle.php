<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;

    protected $fillable = [
        'brand',
        'model',
        'plate_number',
        'color',
        'year',
        'last_maintenance_date',
        'next_maintenance_date',
        'status',
        'created_at',
        'updated_at',
        'latitude',
        'longitude',
    ];
}
