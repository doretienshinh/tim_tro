<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Services\Hostel\UserHostelService;
use App\Models\Hostel;
use Illuminate\Support\Facades\Session;
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
        $hostels_by_ward = $this->HostelService->findByWardId($Hostel->ward_id);

        return view('user.hostel.detail', [
            'hostel' => $Hostel,
            'hostels_by_ward' => $hostels_by_ward
        ]);
    }

    public function register(Hostel $Hostel)
    {
        $this->HostelService->register($Hostel);

        return redirect()->back();
    }

    public function registerDetail()
    {
        $hostel = $this->HostelService->getCurrentRegister() ? $this->HostelService->getCurrentRegister()->hostel : $this->HostelService->getCurrentRegister();
        if (!$hostel)
        {
            Session::flash('warning','Bạn không có trọ nào trong mục này');

            return redirect()->back();
        } 
        $hostels_by_ward = $this->HostelService->findByWardId($hostel->ward_id);

        return view('user.hostel.detail', [
            'hostel' => $hostel,
            'hostels_by_ward' => $hostels_by_ward
        ]);
    }
}
