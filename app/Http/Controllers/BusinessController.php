<?php

namespace App\Http\Controllers;

use App\Models\Business;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class BusinessController extends Controller
{
    public function show(Request $request, string $url): View
    {
        $business = Business::where('url', $url)->first();
        if (!$business) {
            abort(404, __('global.business_not_found'));
        }
        $user = User::find($business->user_id);
        $reviews = $user
            ->reviews()
            ->orderBy('updated_at', 'desc')
            ->simplePaginate(3, ['*'], 'reviewPage');
        $query = $user->ads();
        $request->flash();

        if (!is_null($request->input('search'))) {
            $query->where('name', 'like', '%' . $request->input('search', '') . '%');
        }

        if (!is_null($request->input('sort_by'))) {
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

        return view('business.details', ['business' => $business, 'user' => $user, 'ad_type' => $ad_type, 'reviews' => $reviews, 'ads' => $query->paginate(8)]);
    }

    public function edit(): View
    {
        $user = Auth::user();
        if (!$user->type->isBusiness()) {
            return redirect(route('profile.edit'));
        }
        $business = $user->business;
        return view('business.settings', ['user' => $user, 'business' => $business, 'ads' => $user->ads]);
    }

    public function update(Request $request): RedirectResponse
    {
        $user = User::find(Auth::user()->id);

        if ($request->hasFile('profilePicture')) {
            $profilePictureUrl = $request->file('profilePicture')->storeAs('public/profile-pictures', $user->username . '.' . $request->file('profilePicture')->extension());
        } else {
            $profilePictureUrl = $user->image;
        }
        if ($request->hasFile('banner_image')) {
            $bannerUrl = $request->file('banner_image')->storeAs('public/business-banners', $user->username . '.' . $request->file('banner_image')->extension());
        } else {
            $bannerUrl = $user->business->image;
        }
        $layout = $request->layout;
        foreach ($layout as $colIndex => $col) {
            foreach ($col as $sectionIndex => $section) {
                if ($section[0] == 'image') {
                    $url = $section['image']->storeAs('public/business-images', $user->username . $colIndex . '-' . $sectionIndex . '.' . $section['image']->extension());
                    $layout[$colIndex][$sectionIndex]['image'] = $url;
                }
            }
        }

        $user->update([
            'name' => $request->name,
            'image' => $profilePictureUrl,
        ]);
        $user->business()->update([
            'layout' => $layout,
            'primary_color' => $request->primary_color,
            'secondary_color' => $request->secondary_color,
            'banner_image' => $bannerUrl,
        ]);
        return redirect()->back()->with('success', __('global.business_settings_updated'));
    }

    public function apiKeys(): View
    {
        $user = Auth::user();
        if (!$user->type->isBusiness()) {
            return redirect(403);
        }
        $newKey = session('new_key', '');
        return view('business.api-keys', ['api_keys' => $user->tokens, 'new_key' => $newKey]);
    }

    public function destroyApiKey(string $token): RedirectResponse
    {
        $user = Auth::user();
        if (!$user->type->isBusiness()) {
            return redirect(403);
        }
        $user->tokens()->where('id', $token)->delete();
        
        return redirect()->back()->with('success', __('global.api_key_destroyed'));
    }

    public function generateApiKey(Request $request): RedirectResponse
    {
        $user = Auth::user();
        if (!$user->type->isBusiness()) {
            return redirect(403);
        }
        $token = Auth::user()->createToken($request->name)->plainTextToken;
        session()->flash('new_key', $token);
        return redirect()->back()->with('success', __('global.api_key_generated'));
    }
}
