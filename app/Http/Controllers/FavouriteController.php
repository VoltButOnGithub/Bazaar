<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class FavouriteController extends Controller
{
    public function favourite(int $id): RedirectResponse
    {
        if (Auth::user()->hasFavourited($id)) {
            return abort(403);
        }
        Auth::user()->favourites()->attach($id);

        return redirect()->back()->with('success', __('global.added_to_favourites'));
    }

    public function unfavourite(int $id): RedirectResponse
    {
        if (! Auth::user()->hasFavourited($id)) {
            return abort(403);
        }
        Auth::user()->favourites()->detach($id);

        return redirect()->back()->with('success', __('global.removed_from_favourites'));
    }
}
