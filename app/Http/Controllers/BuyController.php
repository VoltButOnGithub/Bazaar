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
        if (Auth::user()->isOwnerOf($id) || Auth::user()->hasBought($id)) {
            return abort(403);
        }
        Ad::find($id)->update([
            'buyer_id' => Auth::user()->id,
        ]);

        return redirect()->back();
    }
}
