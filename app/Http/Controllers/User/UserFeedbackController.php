<?php

namespace App\Http\Controllers\User;

use App\Models\Feedback_hostel;
use Illuminate\Http\Request;
use App\Http\Services\Feedback\FeedbackHostelService;
use App\Http\Controllers\Controller;

class UserFeedbackController extends Controller
{
    protected $FeedbackHostelService;

    public function __construct(FeedbackHostelService $FeedbackHostelService,) {
        $this->FeedbackHostelService = $FeedbackHostelService;
    }

    public function feedback(Request $request, $id)
    {
        $hostels = $this->FeedbackHostelService->store($request->all(), $id);

        return redirect()->back();
    }

    public function destroy(Hostel $hostel)
    {
        $this->FavoriteService->destroy($hostel);

        return redirect()->back();
    }
}
