<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use App\Models\Booking;
use App\Models\Vehicle;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;

class BookingController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Booking/BookingDashboard', [
            'booking' => Booking::all(),
            'vehicles' => Vehicle::all()
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'start_date' => ['required', 'date'],
            'end_date' => ['required', 'date'],
            'vehicle_id' => ['required', 'int'],
            'booked_by' => ['required', 'int'],
            'notes' => ['nullable', 'string', 'max:255'],
        ]);

        Booking::create([
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'vehicle_id' => $request->vehicle_id,
            'booked_by' => $request->booked_by,
            'notes' => $request->notes ?: null,
            'status' => 'Pending'
        ]);

        return Redirect::route('booking.index');
    }
}
