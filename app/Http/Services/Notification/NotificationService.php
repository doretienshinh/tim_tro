<?php

namespace App\Http\Services\Notification;

use App\Models\Notification;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class NotificationService
{
    public function getAll()
    {
        return Notification::orderByDesc('id')->paginate(config('app.page')[1]);
    }

    public function find($id)
    {
        return Notification::where('id', $id)->first();
    }

    public function store($request)
    {
        $url = 'https://fcm.googleapis.com/fcm/send';
        if($request->user_id == Auth::user()->id) {
            $FcmToken = User::whereNotNull('device_key')->where('id', '!=', Auth::user()->id)->pluck('device_key')->all();
        }
        else {
            $FcmToken = User::whereNotNull('device_key')->where('id', '=', $request->user_id)->pluck('device_key')->all();
        }

        try {
            if($request->user_id == Auth::user()->id) {
                $users = User::where('id', '!=', 1)->get();
                foreach($users as $user){
                    $request->merge([
                        'user_id' => $user->id,
                    ]);
                    Notification::create($request->all());
                }
            }
            else Notification::create($request->all());
            Session::flash('success','Gửi thông báo thành công');

            $serverKey = 'AAAAscnH4Dg:APA91bGTMDc270FxJRCjoKQ70c7YuAyEAcufy-LXIdM4rnbtb1aU56kKe9EUdvAKlrcIbR4ZJ-VfhbfziZvdqNnofHoLismCXQ1FwkuHM7RSJctpYN5ImiLk9Y3ro__ANUFoeozDrai8';
  
            $data = [
                "registration_ids" => $FcmToken,
                "notification" => [
                    "title" => $request->title,
                    "body" => $request->content,  
                ]
            ];
            $encodedData = json_encode($data);

            $headers = [
                'Authorization:key=' . $serverKey,
                'Content-Type: application/json',
            ];
        
            $ch = curl_init();
        
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
            // Disabling SSL Certificate support temporarly
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);        
            curl_setopt($ch, CURLOPT_POSTFIELDS, $encodedData);
            // Execute post
            $result = curl_exec($ch);
            if ($result === FALSE) {
                die('Curl failed: ' . curl_error($ch));
            }        
            // Close connection
            curl_close($ch);
            // FCM response

        } catch (\Exception $err){
            Session::flash('error','Gửi thông báo thất bại');
            \Log::info($err->getMessage());
            return false;
        }
        return true;

    }

    public function read($id)
    {
        $notification = Notification::where('id', $id)->first();

        try {
            $notification->read_status = 'read';
            $notification->save();
        } catch (\Exception $err){
            \Log::info($err->getMessage());
            return $err->getMessage();
        }
        return true;
    }

    public function update($id, $data)
    {
       
    }

    public function autoStoreToken($token)
    {

        try {
            Auth::user()->update(['device_key' => $token]);
            Session::flash('success','Lưu token thành công');
        } catch (\Exception $err){
            Session::flash('error','Lưu token thất bại');
            \Log::info($err->getMessage());
            return false;
        }

        return true;
    }

    public function storeToken($token)
    {
        try {
            Auth::user()->update(['device_key' => $token]);
            Session::flash('success','Lưu token thành công');
        } catch (\Exception $err){
            Session::flash('error','Lưu token thất bại');
            \Log::info($err->getMessage());
            return false;
            }
        return true;
    }

    public function sendNotification($request)
    {
        $url = 'https://fcm.googleapis.com/fcm/send';
        $FcmToken = User::whereNotNull('device_key')->pluck('device_key')->all();
        $serverKey = 'AAAAscnH4Dg:APA91bGTMDc270FxJRCjoKQ70c7YuAyEAcufy-LXIdM4rnbtb1aU56kKe9EUdvAKlrcIbR4ZJ-VfhbfziZvdqNnofHoLismCXQ1FwkuHM7RSJctpYN5ImiLk9Y3ro__ANUFoeozDrai8';
  
        $data = [
            "registration_ids" => $FcmToken,
            "notification" => [
                "title" => $request->title,
                "body" => $request->body,  
            ]
        ];
        $encodedData = json_encode($data);

        $headers = [
            'Authorization:key=' . $serverKey,
            'Content-Type: application/json',
        ];
    
        $ch = curl_init();
      
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        // Disabling SSL Certificate support temporarly
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);        
        curl_setopt($ch, CURLOPT_POSTFIELDS, $encodedData);
        // Execute post
        $result = curl_exec($ch);
        if ($result === FALSE) {
            die('Curl failed: ' . curl_error($ch));
        }        
        // Close connection
        curl_close($ch);
        // FCM response
        // dd($result);   

        return true;
    }

    public function notification($id, $title, $content)
    {
        $url = 'https://fcm.googleapis.com/fcm/send';
        $FcmToken = User::whereNotNull('device_key')->where('id', '=', $id)->pluck('device_key')->all();

        try 
        {
            $data_noti['title'] = $title;
            $data_noti['content'] = $content;
            $data_noti['user_id'] = $id;

            Notification::create($data_noti);

            $serverKey = 'AAAAscnH4Dg:APA91bGTMDc270FxJRCjoKQ70c7YuAyEAcufy-LXIdM4rnbtb1aU56kKe9EUdvAKlrcIbR4ZJ-VfhbfziZvdqNnofHoLismCXQ1FwkuHM7RSJctpYN5ImiLk9Y3ro__ANUFoeozDrai8';
  
            $data = [
                "registration_ids" => $FcmToken,
                "notification" => [
                    "title" => $title,
                    "body" => $content,  
                ]
            ];
            $encodedData = json_encode($data);

            $headers = [
                'Authorization:key=' . $serverKey,
                'Content-Type: application/json',
            ];
        
            $ch = curl_init();
        
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
            // Disabling SSL Certificate support temporarly
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);        
            curl_setopt($ch, CURLOPT_POSTFIELDS, $encodedData);
            // Execute post
            $result = curl_exec($ch);
            if ($result === FALSE) {
                die('Curl failed: ' . curl_error($ch));
            }        
            // Close connection
            curl_close($ch);
            // FCM response

        } catch (\Exception $err){
            \Log::info($err->getMessage());
            return false;
        }
        return true;

    }
}
