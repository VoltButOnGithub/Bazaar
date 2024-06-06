<?php

namespace App\Http\Controllers;

use App\Enum\AdTypesEnum;
use App\Http\Requests\StoreAdRequest;
use App\Models\Ad;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

use function PHPUnit\Framework\isNull;

class FavouriteController extends Controller
{
    public function favourite(int $id): RedirectResponse
    {
        if(!Auth::check()) {
            return redirect()->back();
        }
        Auth::user()->favourites()->attach($id);
        return redirect()->back();
    }

    public function unfavourite(int $id): RedirectResponse
    {
        if(!Auth::check()) {
            return redirect()->back();
        }
        Auth::user()->favourites()->detach($id);
        return redirect()->back();
    }
}
