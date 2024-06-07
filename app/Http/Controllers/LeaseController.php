<?php

namespace App\Http\Controllers;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\LeaseRequest;
use App\Models\Lease;
use App\Models\Ad;
use Illuminate\Support\Facades\Auth;

class LeaseController extends Controller
{
    public function lease(LeaseRequest $request, int $id): RedirectResponse
    {
        $request->validated();
        if (! Auth::check()) {
            return redirect()->back();
        }
        $ad = Ad::find($id);
        if (Auth::user()->isOwnerOf($id) || $ad->bought) {
            return abort(403);
        }
        Lease::create([
            'ad_id' => $id,
            'user_id' => Auth::user()->id,
            'start_date' => $request->startDate,
            'end_date' => $request->endDate,
        ]);
        return redirect()->back();
    }
}