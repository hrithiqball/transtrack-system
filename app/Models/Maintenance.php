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

    protected $fillable = [
        'maintenance_date',
        'serviced_by',
        'vehicle_id',
        'remarks'
    ];
}
