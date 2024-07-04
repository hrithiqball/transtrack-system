<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateVehicleRequest;
use App\Http\Requests\UpdateVehicleRequest;
use App\Models\Vehicle;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

class VehicleController extends Controller
{
    public function view(): Response
    {
        return Inertia::render('Vehicle/VehicleDashboard', [
            'vehicles' => Vehicle::all()->map->vehicleDto(),
        ]);
    }

    public function detail(int $id)
    {
        $vehicle = Vehicle::with('maintenances')->findOrFail($id);

        return Inertia::render('Vehicle/VehicleDetail', [
            'vehicle' => $vehicle->vehicleDto(),
            'vehicles' => Vehicle::all()->map->vehicleDto()
        ]);
    }

    public function store(CreateVehicleRequest $request): RedirectResponse
    {
        Vehicle::create($request->validatedWithPhoto());

        return Redirect::route('vehicle.view');
    }

    public function update(UpdateVehicleRequest $request, int $id): RedirectResponse
    {
        $vehicle = Vehicle::findOrFail($id);
        $vehicle->update($request->validated());

        return Redirect::route('vehicle.view');
    }

    public function edit(int $id)
    {
        $vehicle = Vehicle::find($id);

        return Inertia::render('Vehicle/VehicleUpdate', [
            'vehicle' => $vehicle->vehicleDto(),
        ]);
    }

    public function destroy(int $id): RedirectResponse
    {
        $vehicle = Vehicle::findOrFail($id);
        $vehicle->delete();

        return Redirect::route('vehicle.view');
    }
}
