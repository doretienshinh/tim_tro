<?php

namespace App\Http\Controllers\Host;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Services\User\HostUserService;
use Illuminate\Support\Carbon;
use App\Http\Requests\CreateUserRequest;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class HostUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $UserService;

    public function __construct(HostUserService $UserService) {
        $this->UserService = $UserService;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $user = Auth::user();
        
        return view('host.user.detail', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $user = Auth::user();

        return view('host.user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $user = $this->UserService->update($request->all());

        return redirect()->route('host.user.detail');
    }

}
