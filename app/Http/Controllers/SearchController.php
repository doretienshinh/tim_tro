<?php

namespace App\Http\Controllers;

use App\Http\Services\Hostel\HostelService;
use App\Http\Services\Tag\TagService;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Services\User\UserService;
use Illuminate\Support\Carbon;
use App\Http\Requests\CreateUserRequest;

class SearchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $hostelService;
    protected $tagService;

    public function __construct(HostelService $hostelService, TagService $tagService) {
        $this->hostelService = $hostelService;
        $this->tagService = $tagService;
    }

    public function index(Request $request)
    {
        $request->session()->put('keyword', $request->keyword);
        $hostels = $this->hostelService->search($request->keyword);
        $tags = $this->tagService->getAll();

        return view('user.search.index', compact('hostels', 'tags'));
    }

    public function filter(Request $request)
    {
        $tags = $this->tagService->getAll();
        $keywordObject = json_decode($request->keyword, true);
        $keywordArray = [
            'priceRange' => $keywordObject['priceRange'],
            'tag' => $keywordObject['tag'],
            'keyword' => $request->session()->get('keyword')
        ];

        $hostels = $this->hostelService->filter($keywordArray);

        return view('user.search.index', compact('hostels', 'tags'));
    }


}
