<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Ad;
use App\Models\User;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class SettingsController extends Controller
{
    public function showAdsListWithQuery(Request $request, Builder $query, string $queryName): View
    {
        $request->flash();
        if (! is_null($request->input('search'))) {
            $query->where('name', 'like', '%'.$request->input('search', '').'%');
        }

        if (! is_null($request->input('sort_by'))) {
            switch ($request->input('sort_by', 'newest')) {
                case 'newest':
                    $query->orderBy('created_at', 'desc');
                    break;
                case 'oldest':
                    $query->orderBy('created_at', 'asc');
                    break;
                case 'cheapest':
                    $query->orderBy('price', 'asc');
                    break;
                case 'most_expensive':
                    $query->orderBy('price', 'desc');
                    break;
                default:
                    $query->orderBy('created_at', 'desc');
                    break;
            }
        } else {
            $query->orderBy('created_at', 'desc');
        }

        $ad_type = $request->input('ad_type', 'all');
        if ($ad_type != 'all') {
            $query->where('type', $ad_type);
        }

        return view('settings.ads_list', [
            'ads' => $query->paginate(8),
            'ad_type' => $ad_type,
            'query' => $queryName,
        ]);
    }

    public function activeAds(Request $request): View|RedirectResponse
    {
        $query = Auth::user()->ads()->whereNull('buyer_id');

        return $this->showAdsListWithQuery($request, $query, 'active_ads');
    }

    public function boughtAds(Request $request): View|RedirectResponse
    {
        $query = Ad::where('buyer_id', Auth::user()->id);

        return $this->showAdsListWithQuery($request, $query, 'bought_ads');
    }

    public function soldAds(Request $request): View|RedirectResponse
    {
        $query = Auth::user()->ads()->whereNotNull('buyer_id');

        return $this->showAdsListWithQuery($request, $query, 'sold_ads');
    }

    public function favourites(Request $request): View|RedirectResponse
    {
        $query = Auth::user()->favourites();

        return $this->showAdsListWithQuery($request, $query, 'favourites');
    }

    public function editProfile(): View|RedirectResponse
    {
        $user = Auth::user();
        if ($user->type->isBusiness()) {
            return redirect(route('business.edit'));
        }

        return view('settings.profile', ['user' => $user]);
    }

    public function updateProfile(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->validated();
        $user = User::find(Auth::user()->id);

        if ($request->hasFile('profilePicture')) {
            $profilePictureUrl = $request->file('profilePicture')->storeAs('public/profile-pictures', $request->username.'.'.$request->file('profilePicture')->extension());
        } else {
            $profilePictureUrl = $user->image;
        }

        $user->update([
            'name' => $request->name,
            'image' => $profilePictureUrl,
        ]);

        return redirect()->back()->with('success', __('global.profile_updated'));
    }
}
