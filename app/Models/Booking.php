<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    public function bookedBy()
    {
        return $this->belongsTo(User::class, 'booked_by');
    }

    public function bookingDto()
    {
        return [
            'id' => $this->id,
            'startDate' => $this->start_date,
            'endDate' => $this->end_date,
            'vehicle' => $this->vehicle->vehicleDto(),
            'bookedBy' => $this->bookedBy->userDto(),
            'status' => $this->status,
            'notes' => $this->notes
        ];
    }

    public function bookingWoVehicleDto()
    {
        return [
            'id' => $this->id,
            'startDate' => $this->start_date,
            'endDate' => $this->end_date,
            'bookedBy' => $this->bookedBy->userDto(),
            'status' => $this->status,
            'notes' => $this->notes
        ];
    }

    protected $fillable = [
        'start_date',
        'end_date',
        'vehicle_id',
        'booked_by',
        'status',
        'notes'
    ];

    protected $attributes = [
        'status' => 'Pending'
    ];
}
