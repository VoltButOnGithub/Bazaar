<?php

namespace App\Http\Controllers;

use App\Models\Ad;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class BuyController extends Controller
{
    public function buy(int $id): RedirectResponse
    {
        if (! Auth::check()) {
            return redirect()->back();
        }
        $ad = Ad::find($id);
        if (Auth::user()->isOwnerOf($id) || $ad->bought) {
            return abort(403);
        }
        $ad->update([
            'buyer_id' => Auth::user()->id,
        ]);
        return redirect()->back();
    }
}
