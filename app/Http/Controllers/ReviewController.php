<?php

namespace App\Http\Controllers;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\StoreReviewRequest;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function storeAd(StoreReviewRequest $request, int $id): RedirectResponse
    {
        $request->validated();
        if(Auth::user()->hasReviewed($id, 'ad')) {
            return abort(403);
        }
        Review::create([
            'reviewer_id' => Auth::user()->id,
            'ad_id' => $id,
            'message' => $request->message,
            'stars' => $request->stars,
        ]);

        return redirect()->back();
    }

    public function storeUser(StoreReviewRequest $request, int $id): RedirectResponse
    {
        $request->validated();
        if(Auth::user()->hasReviewed($id, 'user')){
            return abort(403);
        }
        Review::create([
            'reviewer_id' => Auth::user()->id,
            'user_id' => $id,
            'message' => $request->message,
            'stars' => $request->stars,
        ]);
        return redirect()->back();
    }

    public function update(StoreReviewRequest $request, int $id): RedirectResponse
    {
        $request->validated();
        Review::find($id)->update([
            'message' => $request->message,
            'stars' => $request->stars,
        ]);
        return redirect()->back();
    }

    public function destroy(int $id): RedirectResponse
    {
        Review::find($id)->delete();
        return redirect()->back();
    }
}
