<?php

namespace App\Http\Controllers\Host;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Services\HostelUser\HostHostelUserService;
use App\Http\Services\Hostel\HostHostelService;
use App\Http\Services\Hostel\HostelService;
use App\Http\Services\Tag\TagService;
use App\Models\Hostel_user;

class HostHostelUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $HostHostelUserService;
    protected $TagService;

    public function __construct(HostHostelUserService $HostHostelUserService, TagService $TagService, HostelService $HostelService) {
        $this->HostHostelUserService = $HostHostelUserService;
        $this->TagService = $TagService;
        $this->HostelService = $HostelService;
    }

    public function index()
    {
        $hostels = $this->HostHostelUserService->getAllHostel();

        return view('host.request.index', compact('hostels'));
    }

    public function index_leave()
    {
        $hostels = $this->HostHostelUserService->getAllHostel();

        return view('host.request.leave.index', compact('hostels'));
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

        return view('host.hostel.detail', [
            'hostel' => $Hostel,
            'hostels_by_ward' => $hostels_by_ward
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Hostel_user  $Hostel_user
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $Hostel_user = $this->HostHostelUserService->find($id);

        return view('host.request.edit', [
            'Hostel_user' => $Hostel_user,
        ]);
    }

    public function edit_leave($id)
    {
        $Hostel_user = $this->HostHostelUserService->find($id);

        return view('host.request.leave.edit', [
            'Hostel_user' => $Hostel_user,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Hostel  $Hostel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Hostel_user $Hostel_user)
    {
        $this->HostHostelUserService->update($request->all(), $Hostel_user);

        return redirect(route('host.request.index'));
    }


    public function update_leave(Request $request, Hostel_user $Hostel_user)
    {
        $this->HostHostelUserService->update_leave($request->all(), $Hostel_user);

        return redirect(route('host.request.index_leave'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Hostel  $Hostel
     * @return \Illuminate\Http\Response
     */
    public function destroy(Hostel $Hostel)
    {
        $result = $this->HostelService->destroy($Hostel);

        if($result){
            return response()->json([
                'error' => false,
                'message'=> 'Xóa trọ thành công'
            ]);
        }
        else return response()->json([
            'error' => true,
        ]);
    }
}
