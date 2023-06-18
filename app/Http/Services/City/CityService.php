<?php

namespace App\Http\Services\City;

use App\Models\City;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;

class CityService
{
    public function getAll()
    {
        return City::orderBy('id', 'ASC')->paginate(config('app.page')[2]);
    }
    
    public function getAllNotHavePagination()
    {
        return City::orderBy('id', 'ASC')->get();
    }

    public function find($id)
    {
        return City::where('id', $id)->first();
    }

    public function store($data)
    {
        
    }

    public function update($id, $data)
    {
       
    }
}
