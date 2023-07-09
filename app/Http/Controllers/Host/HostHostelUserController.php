<?php

namespace App\Http\Controllers\Host;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Services\HostelUser\HostHostelUserService;
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

    public function __construct(HostHostelUserService $HostHostelUserService, TagService $TagService, ) {
        $this->HostHostelUserService = $HostHostelUserService;
        $this->TagService = $TagService;
    }

    public function index()
    {
        $hostels = $this->HostHostelUserService->getAllHostel();

        return view('host.request.index', compact('hostels'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Hostel  $Hostel
     * @return \Illuminate\Http\Response
     */
    public function show(Hostel $Hostel)
    {
        return view('host.hostel.detail', [
            'hostel' => $Hostel,
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