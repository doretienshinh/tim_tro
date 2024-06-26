<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Services\Hostel\HostelService;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    protected $HostelService;
    protected $NotificationService;

    public function __construct(HostelService $HostelService) {
        $this->HostelService = $HostelService;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {        
        if( !Auth::check() || Auth::user()->getRoleNames()[0] == 'user') {
            $hostels = $this->HostelService->getAll();

            return view('user.home.index',[ 'hostels' => $hostels]);
        }
        else if( !Auth::check() || Auth::user()->getRoleNames()[0] == 'host') {
            $hostels = $this->HostelService->getAll();

            return view('host.home.index',[ 'hostels' => $hostels]);
        }
        else return view('admin.home.admin');
    }
}
