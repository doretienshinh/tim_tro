<?php

namespace App\Http\Services\District;

use App\Models\District;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;

class DistrictService
{
    public function getAll()
    {
        return District::orderBy('id', 'ASC')->paginate(config('app.page')[2]);
    }

    public function getAllNotHavePagination()
    {
        return District::orderBy('id', 'ASC')->get();
    }

    public function find($id)
    {
        return District::where('id', $id)->first();
    }

    public function store($data)
    {
        
    }

    public function update($id, $data)
    {
       
    }

    public function findByCity($id)
    {
        return District::where('city_id', $id)->orderBy('id', 'ASC')->get();
    }
}
