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
            'plate_number' => ['nullable', 'string', 'max:255'],
            'color' => ['nullable', 'string', 'max:255'],
            'year' => ['nullable', 'int'],
            'last_maintenance_date' => ['nullable', 'date'],
            'next_maintenance_date' => ['nullable', 'date'],
            'status' => ['nullable', 'string', 'max:255'],
        ]);

        Vehicle::create([
            'brand' => $request->brand,
            'model' => $request->model ?: null,
            'plate_number' => $request->plate_number ?: null,
            'color' => $request->color ?: null,
            'year' => $request->year ?: null,
            'last_maintenance_date' => $request->last_maintenance_date ?: null,
            'next_maintenance_date' => $request->next_maintenance_date ?: null,
            'status' => $request->status ?: null,
        ]);

        return Redirect::route('vehicle.index');
    }
}
