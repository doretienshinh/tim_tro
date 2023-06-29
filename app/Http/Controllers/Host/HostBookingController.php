<?php

namespace App\Http\Controllers\Host;

use App\Models\Booking;
use Illuminate\Http\Request;
use App\Http\Services\Booking\HostBookingService;
use App\Http\Controllers\Controller;

class HostBookingController extends Controller
{
    protected $hostBookingService;

    public function __construct(HostBookingService $hostBookingService,) {
        $this->hostBookingService = $hostBookingService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bookings = $this->hostBookingService->getAll();

        return view('host.booking.index', compact('bookings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function show(Booking $booking)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function edit(Booking $booking)
    {
        return view('host.booking.edit', compact('booking'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Booking $booking)
    {
        $this->hostBookingService->update($request->all(), $booking);

        return redirect(route('host.booking.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function destroy(Booking $booking)
    {
        //
    }

    public function booking(Request $request, $time_id, $hostel_id)
    {
        $userBooking = $this->userBookingService->store($time_id, $hostel_id);

        return redirect()->back();
    }
}
