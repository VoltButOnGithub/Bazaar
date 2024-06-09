<?php

namespace App\Http\Controllers;

use App\Models\Lease;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class CalendarController extends Controller
{
    public function calendar(): View
    {
        $user = Auth::user();

        $renting = $user->leases()->where('end_date', '>=', Carbon::today())->orderBy('start_date', 'asc')->simplePaginate(3, ['*'], 'renting_page');
        $renting_out = Lease::whereHas('ad', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })->where('end_date', '>=', Carbon::today())->simplePaginate(3, ['*'], 'renting_out_page');

        return view('settings.calendar', ['renting' => $renting, 'renting_out' => $renting_out]);
    }
}
