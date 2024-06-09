<?php

namespace App\Http\Controllers;

use App\Http\Requests\LeaseRequest;
use App\Models\Ad;
use App\Models\Lease;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class LeaseController extends Controller
{
    public function lease(LeaseRequest $request, int $id): RedirectResponse
    {
        $request->validated();
        $request->flash();
        $ad = Ad::find($id);
        if (Auth::user()->isOwnerOf($id) || $ad->bought) {
            return abort(403);
        }
        $start = $request->startDate;
        $end = $request->endDate;
        $rented = $ad->leases()->where(function ($query) use ($start, $end) {
            $query->where('start_date', '<', $end)
                ->where('end_date', '>', $start);
        })->first();
        if ($rented) {
            return redirect()->back()->withErrors(['startDate' => __('global.already_rented_between', ['start' => $rented->start_date->format('d-m-Y'), 'end' => $rented->end_date->format('d-m-Y')])]);
        }
        Lease::create([
            'ad_id' => $id,
            'user_id' => Auth::user()->id,
            'start_date' => $start,
            'end_date' => $end,
        ]);

        return redirect()->back()->with('success', __('global.rented'));
    }
}
