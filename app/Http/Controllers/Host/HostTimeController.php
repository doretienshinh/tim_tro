<?php

namespace App\Http\Controllers\Host;

use App\Models\time;
use Illuminate\Http\Request;
use App\Http\Services\Time\HostTimeService;
use App\Http\Requests\CreateTimeRequest;
use App\Http\Controllers\Controller;

class HostTimeController extends Controller
{
    protected $TimeService;

    public function __construct(HostTimeService $TimeService, ) {
        $this->TimeService = $TimeService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $times = $this->TimeService->getAllMyTime();

        return view('host.time.index', compact('times'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('host.time.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateTimeRequest $request)
    {
        $times = $this->TimeService->store($request->all());

        return redirect()->route('host.time.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\time  $time
     * @return \Illuminate\Http\Response
     */
    public function show(time $time)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\time  $time
     * @return \Illuminate\Http\Response
     */
    public function edit(time $time)
    {
        return view('host.time.edit', compact('time'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\time  $time
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, time $time)
    {
        $this->TimeService->update($request->all(), $time);

        return redirect(route('host.time.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\time  $time
     * @return \Illuminate\Http\Response
     */
    public function destroy(time $time)
    {
        $this->TimeService->destroy($time);

        return redirect(route('host.time.index'));
    }
}
