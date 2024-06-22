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
        $maintenances = Maintenance::with(['vehicle', 'servicedBy'])->get()->map->maintenanceDto();

        return Inertia::render('Maintenance/MaintenanceDashboard', [
            'maintenances' => $maintenances,
        ]);
    }

    public function detail(int $id)
    {
        $maintenance = Maintenance::with(['vehicle', 'servicedBy'])->findOrFail($id);

        return Inertia::render('Maintenance/MaintenanceDetail', [
            'maintenance' => $maintenance->maintenanceDto(),
        ]);
    }

    public function store(CreateMaintenanceRequest $request): RedirectResponse
    {
        Maintenance::create($request->validated());

        return Redirect::route('maintenance.view');
    }

    public function update(UpdateMaintenanceRequest $request, int $id): RedirectResponse
    {
        $maintenance = Maintenance::findOrFail($id);
        $maintenance->update($request->validated());

        return Redirect::route('maintenance.detail', $id);
    }

    public function destroy(int $id): RedirectResponse
    {
        $maintenance = Maintenance::findOrFail($id);
        $maintenance->delete();

        return Redirect::route('maintenance.view');
    }
}
