<?php

namespace App\Http\Controllers;

use App\Http\Requests\BidRequest;
use App\Models\Ad;
use App\Models\Bid;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class BidController extends Controller
{
    public function bid(BidRequest $request, int $id): RedirectResponse
    {
        $request->validated();
        if (! Auth::check()) {
            return redirect()->back();
        }
        $ad = Ad::find($id);
        if (Auth::user()->isOwnerOf($id) || $ad->bought) {
            return abort(403);
        }
        if ($ad->highestBid > $request->bid) {
            return redirect()->back();
        }
        Bid::create([
            'ad_id' => $id,
            'user_id' => Auth::user()->id,
            'amount' => $request->bid,
        ]);

        return redirect()->back()->with('success', __('global.bid_placed'));
    }

    public function finishAuction(int $id): RedirectResponse
    {
        if (! Auth::check()) {
            return redirect()->back();
        }
        if (! Auth::user()->isOwnerOf($id)) {
            return abort(403);
        }
        $ad = Ad::find($id);
        $ad->update([
            'buyer_id' => $ad->highestBidder,
        ]);

        return redirect()->back()->with('success', __('global.auction_finished'));
    }
}
