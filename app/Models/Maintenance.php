<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Maintenance extends Model
{
    use HasFactory;

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    public function servicedBy()
    {
        return $this->belongsTo(User::class, 'serviced_by');
    }

    public function maintenanceDto()
    {
        return [
            'id' => $this->id,
            'maintenanceDate' => $this->maintenance_date,
            'vehicle' => $this->vehicle,
            'servicedBy' => $this->servicedBy,
            'remarks' => $this->remarks
        ];
    }

    protected $fillable = [
        'maintenance_date',
        'serviced_by',
        'vehicle_id',
        'remarks'
    ];
}
