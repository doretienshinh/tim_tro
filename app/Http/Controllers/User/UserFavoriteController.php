<?php

namespace App\Http\Controllers\User;

use App\Models\Favorite;
use App\Models\Hostel;
use Illuminate\Http\Request;
use App\Http\Services\Favorite\FavoriteService;
use App\Http\Controllers\Controller;

class UserFavoriteController extends Controller
{
    protected $FavoriteService;

    public function __construct(FavoriteService $FavoriteService,) {
        $this->FavoriteService = $FavoriteService;
    }

    public function index()
    {
        $hostels = $this->FavoriteService->getAllMyFavorite();

        return view('user.favorite.index', compact('hostels'));
    }

    public function store(Hostel $hostel)
    {
        $hostels = $this->FavoriteService->store($hostel);

        return redirect()->back();
    }

    public function destroy(Hostel $hostel)
    {
        $this->FavoriteService->destroy($hostel);

        return redirect()->back();
    }
}
