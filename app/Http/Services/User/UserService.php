<?php

namespace App\Http\Services\User;

use App\Models\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;

class UserService
{
    public function getAll()
    {
        return User::orderByDesc('id')->paginate(config('app.page')[2]);
    }

    public function find($id)
    {
        return User::where('id', $id)->first();
    }

    public function store($data)
    {
        if (isset($data['avatar'])) {
            $urlName = Carbon::now()->format('Y-m-d-H-i-s') . $data['avatar']->getClientOriginalName();;
            $pathUrl = Storage::disk('public')->put('avatar/' . $urlName, file_get_contents($data['avatar']->getRealPath()));
            $data['avatar'] = 'avatar/' . $urlName;
        } 
        if (isset($data['student_card'])) {
            $urlName = Carbon::now()->format('Y-m-d-H-i-s') . $data['student_card']->getClientOriginalName();;
            $pathUrl = Storage::disk('public')->put('student_card/' . $urlName, file_get_contents($data['student_card']->getRealPath()));
            $data['student_card'] = 'student_card/' . $urlName;
        } 
        if (isset($data['citizen_identification'])) {
            $urlName = Carbon::now()->format('Y-m-d-H-i-s') . $data['citizen_identification']->getClientOriginalName();;
            $pathUrl = Storage::disk('public')->put('citizen_identification/' . $urlName, file_get_contents($data['citizen_identification']->getRealPath()));
            $data['citizen_identification'] = 'citizen_identification/' . $urlName;
        }

        $user = User::create($data);
        if($data['role'] == 'admin')
        {
            $user->assignRole('admin');
        }
        else if ($data['role'] == 'host')
        {
            $user->assignRole('host');
        }
        else $user->assignRole('user');
        
        return $user;
    }

    public function update($id, $data)
    {
        $user = User::where('id', $id)->first();

        if (isset($data['avatar'])) {
            if($user->avatar) Storage::delete($user->avatar);
            $urlName = Carbon::now()->format('Y-m-d-H-i-s') . $data['avatar']->getClientOriginalName();;
            $pathUrl = Storage::disk('public')->put('avatar/' . $urlName, file_get_contents($data['avatar']->getRealPath()));
            $data['avatar'] = 'avatar/' . $urlName;
        } 
        if (isset($data['student_card'])) {
            if($user->student_card) Storage::delete($user->student_card);
            $urlName = Carbon::now()->format('Y-m-d-H-i-s') . $data['student_card']->getClientOriginalName();;
            $pathUrl = Storage::disk('public')->put('student_card/' . $urlName, file_get_contents($data['student_card']->getRealPath()));
            $data['student_card'] = 'student_card/' . $urlName;
        } 
        if (isset($data['citizen_identification'])) {
            if($user->citizen_identification) Storage::delete($user->citizen_identification);
            $urlName = Carbon::now()->format('Y-m-d-H-i-s') . $data['citizen_identification']->getClientOriginalName();;
            $pathUrl = Storage::disk('public')->put('citizen_identification/' . $urlName, file_get_contents($data['citizen_identification']->getRealPath()));
            $data['citizen_identification'] = 'citizen_identification/' . $urlName;
        }

        $user->syncRoles($data['role']);
        $user = $user->update([
            'name' => $data['name'],
            'email' =>  $user->email,
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'gender' => $data['gender'],
            'phone_number' => $data['phone_number'],
            'address' => $data['address'],
            'birthday' => $data['birthday'],
            'school' => $data['school'],
            'avatar' => isset($data['avatar']) ? $data['avatar'] : $user->avatar,
            'student_card' => isset($data['student_card']) ? $data['student_card'] : $user->student_card,
            'citizen_identification' => isset($data['citizen_identification']) ? $data['citizen_identification'] : $user->citizen_identification,
        ]);

        
        return $user;
    }
}
