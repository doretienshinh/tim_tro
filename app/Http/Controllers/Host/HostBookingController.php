<?php

namespace App\Http\Controllers\Host;

use App\Models\Booking;
use Illuminate\Http\Request;
use App\Http\Services\Booking\HostBookingService;
use App\Http\Services\Hostel\HostelService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class HostBookingController extends Controller
{
    protected $hostBookingService;
    protected $HostelService;

    public function __construct(HostBookingService $hostBookingService, HostelService $HostelService,) {
        $this->hostBookingService = $hostBookingService;
        $this->HostelService = $HostelService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $bookings = $this->hostBookingService->getAll();
        $hostels = $this->HostelService->getAll();

        return view('host.booking.index', compact('hostels'));
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
