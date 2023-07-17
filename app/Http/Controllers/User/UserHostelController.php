<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use App\Http\Services\Hostel\UserHostelService;
use App\Models\Hostel;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\CreateHostelRequest;
use App\Http\Services\Notification\NotificationService;
use Illuminate\Support\Facades\Auth;

class UserHostelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $HostelService;
    protected $NotificationService;

    public function __construct(UserHostelService $HostHostelService, NotificationService $NotificationService) {
        $this->HostelService = $HostHostelService;
        $this->NotificationService = $NotificationService;
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
        $result = $this->HostelService->register($Hostel);
        if($result) {
            $result = $this->NotificationService->notification($Hostel->user->id, 'Trọ ['. $Hostel->title . '] có người đăng ký', Auth::user()->name . ' đã gửi yêu cầu vào trọ ['. $Hostel->title . '] ');
        }
        if($result) {
            Session::flash('success','Đã gửi yêu cầu tới chủ trọ');
        }
        else    Session::flash('error','Gửi yêu cầu tới chủ trọ thất bại');

        return redirect()->back();
    }

    public function registerDetail()
    {
        $hostel = $this->HostelService->getCurrentRegister() ? $this->HostelService->getCurrentRegister()->hostel : $this->HostelService->getCurrentRegister();

        if (!$hostel)
        {
            Session::flash('warning','Bạn không có trọ nào trong mục này');

            return redirect()->route('home');
        } 

        $hostels_by_ward = $this->HostelService->findByWardId($hostel->ward_id);

        return view('user.hostel.detail', [
            'hostel' => $hostel,
            'hostels_by_ward' => $hostels_by_ward
        ]);
    }

    public function leave()
    {
        $result = $this->HostelService->leave();
        $hostel_user = $this->HostelService->getCurrentRegister();
        if($result) {
            $result = $this->NotificationService->notification($hostel_user->hostel->user_id, Auth::user()->name . ' đã yêu cầu rời trọ', Auth::user()->name . ' đã gửi yêu cầu rời trọ ['. $hostel_user->hostel->title . '] ');
        }
        if($result) {
            Session::flash('success','Đã gửi yêu cầu tới chủ trọ');
        }
        else    Session::flash('error','Gửi yêu cầu tới chủ trọ thất bại');

        return redirect()->back();
    }
}
