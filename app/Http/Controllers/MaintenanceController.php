<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateMaintenanceRequest;
use App\Http\Requests\UpdateMaintenanceRequest;
use App\Models\Maintenance;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

class MaintenanceController extends Controller
{
    public function view(): Response
    {
        $maintenances = Maintenance::with(['vehicle', 'servicedBy'])->get()->map(function ($maintenance) {
            return [
                'maintenanceDate' => $maintenance->maintenance_date,
                'vehicle' => $maintenance->vehicle,
                'servicedBy' => $maintenance->servicedBy,
            ];
        });

        return Inertia::render('Maintenance/MaintenanceDashboard', [
            'maintenances' => $maintenances,
        ]);
    }

    public function store(CreateMaintenanceRequest $request): RedirectResponse
    {
        Maintenance::create($request->validated());

        return Redirect::route('maintenance.view');
    }

    public function update(UpdateMaintenanceRequest $request): RedirectResponse
    {
        $maintenance = Maintenance::findOrFail($request->id);
        $maintenance->update($request->validated());

        return Redirect::route('maintenance.view');
    }

    public function destroy(int $id): RedirectResponse
    {
        $maintenance = Maintenance::findOrFail($id);
        $maintenance->delete();

        return Redirect::route('maintenance.view');
    }
}
