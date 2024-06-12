<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class DashboardController extends Controller
{
    //
    public function view(): Response
    {
        return Inertia::render('Dashboard/MainDashboard', [
            'vehicles' => Vehicle::all()->map->vehicleDto()
        ]);
    }
}
