<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Services\Hostel\UserHostelService;
use App\Models\Hostel;
use App\Http\Requests\CreateHostelRequest;

class UserHostelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $HostelService;

    public function __construct(UserHostelService $HostHostelService,) {
        $this->HostelService = $HostHostelService;
    }

    public function index()
    {
        $hostels = $this->HostelService->getAll();

        return view('user.hostel.index', compact('hostels'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Hostel  $Hostel
     * @return \Illuminate\Http\Response
     */
    public function show(Hostel $Hostel)
    {
        return view('user.hostel.detail', [
            'hostel' => $Hostel,
        ]);
    }

}
