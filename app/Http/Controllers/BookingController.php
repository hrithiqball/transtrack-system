<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use App\Models\Booking;
use App\Models\Vehicle;

class BookingController extends Controller
{
    // Booking dashboard
    public function index(): Response {
        return Inertia::render('Booking/BookingDashboard', [
            // 'booking' => Booking::all(),
            'vehicles' => Vehicle::all()
        ]);
    }
}
