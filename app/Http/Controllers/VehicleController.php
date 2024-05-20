<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateVehicleRequest;
use App\Models\Vehicle;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

class VehicleController extends Controller
{
    // View
    public function view(): Response
    {
        return Inertia::render('Vehicle/VehicleDashboard', [
            'vehicles' => Vehicle::all(),
        ]);
    }

    public function detail(int $id)
    {
        $vehicle = Vehicle::find($id);
        return Inertia::render('Vehicle/VehicleDetail', [
            'vehicle' => $vehicle,
        ]);
    }

    public function edit(int $id)
    {
        $vehicle = Vehicle::find($id);
        return Inertia::render('Vehicle/VehicleUpdate', [
            'vehicle' => $vehicle,
        ]);
    }

    // Operations
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
            'latitude' => ['nullable', 'regex:/^[-]?([0-8]?[0-9]|90)\.[0-9]{1,6}$/'],
            'longitude' => ['nullable', 'regex:/^[-]?((1[0-7][0-9])|([0-9]?[0-9]))\.[0-9]{1,6}$/'],
            'photo' => ['nullable', 'image', 'max:2048']
        ]);

        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('public/vehicles');
            $photoPath = str_replace('public/', '', $photoPath);
            $request->merge(['photo' => $photoPath]);
        }

        Vehicle::create([
            'brand' => $request->brand,
            'model' => $request->model ?: null,
            'plate_number' => $request->plate_number ?: null,
            'color' => $request->color ?: null,
            'year' => $request->year ?: null,
            'last_maintenance_date' => $request->last_maintenance_date ?: null,
            'next_maintenance_date' => $request->next_maintenance_date ?: null,
            'status' => $request->status ?: null,
            'latitude' => $request->latitude ?: null,
            'longitude' => $request->longitude ?: null,
            'photo' => $request->hasFile('photo') ? $photoPath : null
        ]);

        return Redirect::route('vehicle.view');
    }

    public function update(UpdateVehicleRequest $request, int $id)
    {
        $vehicle = Vehicle::find($id);
        $vehicle->update($request->validated());

        return redirect()->route('vehicle.view');
    }

    public function destroy(int $id)
    {
        $vehicle = Vehicle::findOrFail($id);
        $vehicle->delete();

        return Redirect::route('vehicle.view');
    }
}
