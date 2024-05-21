<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Maintenance;

class Vehicle extends Model
{
    use HasFactory;

    public function maintenances()
    {
        return $this->hasMany(Maintenance::class);
    }

    public function vehicleDto()
    {
        return [
            'id' => $this->id,
            'brand' => $this->brand,
            'model' => $this->model,
            'plateNumber' => $this->plate_number,
            'color' => $this->color,
            'year' => $this->year,
            'maintenances' => $this->maintenances->map->maintenanceDto(),
            'status' => $this->status,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'photo' => $this->photo
        ];
    }

    protected $fillable = [
        'brand',
        'model',
        'plate_number',
        'color',
        'year',
        'status',
        'latitude',
        'longitude',
        'photo'
    ];
}
