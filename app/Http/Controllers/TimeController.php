<?php

namespace App\Http\Controllers;

use App\Models\time;
use Illuminate\Http\Request;
use App\Http\Services\Time\TimeService;
use App\Http\Requests\CreateTimeRequest;

class TimeController extends Controller
{
    protected $TimeService;

    public function __construct(TimeService $TimeService, ) {
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

        return view('time.index', compact('times'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('time.create');
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

        return redirect()->route('admin.time.index');
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
        return view('time.edit', compact('time'));
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

        return redirect(route('admin.time.index'));
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

        return redirect(route('admin.time.index'));
    }
}
