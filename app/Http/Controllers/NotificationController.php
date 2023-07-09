<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Services\Notification\NotificationService;
use App\Http\Services\User\UserService;
use Illuminate\Support\Carbon;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $NotificationService;

    public function __construct(NotificationService $NotificationService, UserService $UserService) {
        $this->NotificationService = $NotificationService;
        $this->UserService = $UserService;
    }

    // public function index()
    // {
    //     $notifications = $this->NotificationService->getAll();

    //     return view('admin.notification.index', compact('notifications'));
    // }

    public function index()
    {
        $notifications  = $this->NotificationService->getAll();

        return view('admin.notification.index', compact('notifications'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = $this->UserService->getAllNotHavePagination();

        return view('admin.notification.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $notification = $this->NotificationService->store($request);

        return redirect()->route('admin.notification.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function show(Notification $notification)
    {
        return view('admin.notification.detail', compact('notification'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function edit(Notification $notification)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Notification $notification)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function destroy(Notification $notification)
    {
        //
    }

    public function storeToken(Request $request)
    {
        auth()->user()->update(['device_key'=>$request->token]);
        return response()->json(['Token successfully stored.']);
    }

    public function autoStoreToken(Request $request)
    {
        $result = $this->NotificationService->autoStoreToken($request->token);

        return $result;
    }

    public function sendNotification(Request $request)
    {
        $result = $this->NotificationService->sendNotification($request);

        return view('admin.notification.index');
    }

    public function read($id)
    {
        $result = $this->NotificationService->read($id);

        return $result;
    }
}
