<?php

namespace App\Http\Controllers\Host;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Services\Hostel\HostHostelService;
use App\Http\Services\Tag\TagService;
use App\Models\Hostel;
use App\Http\Requests\CreateHostelRequest;

class HostHostelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $HostelService;
    protected $TagService;

    public function __construct(HostHostelService $HostHostelService, TagService $TagService, ) {
        $this->HostelService = $HostHostelService;
        $this->TagService = $TagService;
    }

    public function index()
    {
        $hostels = $this->HostelService->getAll();

        return view('host.hostel.index', compact('hostels'));
    }

    public function leased()
    {
        $hostels = $this->HostelService->getAll();

        return view('host.hostel.leased', compact('hostels'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tags = $this->TagService->getAllNotHavePagination();

        return view('host.hostel.create', compact('tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateHostelRequest $request)
    {
        // dd($request->all());

        $hostels = $this->HostelService->store($request->all());

        return redirect()->route('host.hostel.index');
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
     * @param  \App\Models\Hostel  $Hostel
     * @return \Illuminate\Http\Response
     */
    public function edit(Hostel $Hostel)
    {
        $tags = $this->TagService->getAllNotHavePagination();

        return view('host.hostel.edit', [
            'hostel' => $Hostel,
            'tags' => $tags,
        ]);
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
        $this->HostelService->update($request->all(), $Hostel);

        return redirect(route('host.hostel.index'));
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
