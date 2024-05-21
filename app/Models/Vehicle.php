<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;

    public function toViewObject()
    {
        return [
            'id' => $this->id,
            'brand' => $this->brand,
            'model' => $this->model,
            'plateNumber' => $this->plate_number,
            'color' => $this->color,
            'year' => $this->year,
            'lastMaintenanceDate' => $this->last_maintenance_date,
            'nextMaintenanceDate' => $this->next_maintenance_date,
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
        'last_maintenance_date',
        'next_maintenance_date',
        'status',
        'latitude',
        'longitude',
        'photo'
    ];
}
