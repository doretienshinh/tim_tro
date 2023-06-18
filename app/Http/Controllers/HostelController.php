<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\Hostel\HostelService;
use App\Http\Services\Tag\TagService;
use App\Http\Services\City\CityService;
use App\Http\Services\District\DistrictService;
use App\Http\Services\Ward\WardService;

class HostelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $HostelService;

    public function __construct(HostelService $HostelService, TagService $TagService, CityService $CityService, DistrictService $DistrictService, WardService $WardService) {
        $this->HostelService = $HostelService;
        $this->TagService = $TagService;
        $this->CityService = $CityService;
        $this->DistrictService = $DistrictService;
        $this->WardService = $WardService;
    }

    public function index()
    {
        $hostels = $this->HostelService->getAll();

        return view('hostel.index', compact('hostels'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tags = $this->TagService->getAllNotHavePagination();
        $cities = $this->CityService->getAllNotHavePagination();
        $districts = $this->DistrictService->getAllNotHavePagination();
        $wards = $this->WardService->getAllNotHavePagination();

        return view('hostel.create', compact('tags', 'cities', 'districts', 'wards'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        dd($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Hostel  $Hostel
     * @return \Illuminate\Http\Response
     */
    public function show(Hostel $Hostel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Hostel  $Hostel
     * @return \Illuminate\Http\Response
     */
    public function edit(Hostel $Hostel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Hostel  $Hostel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Hostel $Hostel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Hostel  $Hostel
     * @return \Illuminate\Http\Response
     */
    public function destroy(Hostel $Hostel)
    {
        //
    }
}
