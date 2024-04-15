<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Vehicle;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

class VehicleController extends Controller
{
    // Display all vehicles
    public function index(): Response
    {
        return Inertia::render('Vehicle/Management', [
            // 'vehicles' => Vehicle::all(),
        ]);
    }

    // Store new vehicle
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'brand' => ['required', 'string', 'max:255'],
            'model' => ['nullable', 'string', 'max:255'],
            // 'plate_number' => ['required', 'string', 'max:255'],
            // 'color' => ['required', 'string', 'max:255'],
            // 'year' => ['required', 'string', 'max:255'],
            // 'last_maintenance_date' => ['required', 'date'],
            // 'next_maintenance_date' => ['required', 'date'],
            // 'status' => ['required', 'string', 'max:255'],
        ]);

        Vehicle::create([
            'brand' => $request->brand,
            'model' => $request->model ?: 'Unknown',
        ]);

        return Redirect::route('vehicle.index');
    }
}
