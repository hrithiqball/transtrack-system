<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateBookingRequest;
use App\Http\Requests\UpdateBookingRequest;
use Inertia\Inertia;
use Inertia\Response;
use App\Models\Booking;
use App\Models\Vehicle;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;

class BookingController extends Controller
{
    public function view(): Response
    {
        return Inertia::render('Booking/BookingDashboard', [
            'bookings' => Booking::all()->map->bookingDto(),
            'vehicles' => Vehicle::all()->map->vehicleDto()
        ]);
    }

    public function store(CreateBookingRequest $request): RedirectResponse
    {
        Booking::create($request->validated());

        return Redirect::route('booking.view');
    }

    public function update(UpdateBookingRequest $request, int $id) : RedirectResponse
    {
        $booking = Booking::find($id);
        $booking->update($request->validated());

        return Redirect::route('booking.view');
    }
}
