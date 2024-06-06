<?php

namespace App\Http\Controllers;

use App\Enum\AdTypesEnum;
use App\Http\Requests\StoreAdRequest;
use App\Models\Ad;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class AdController extends Controller
{
    public function create(): View|RedirectResponse
    {
        if (!auth()->check()) {
            return redirect('login');
        }
        $adTypeKeys = \App\Enum\AdTypesEnum::getKeys();
        $fieldIds = ['name', 'description', 'price', 'image'];

        $relatedAds = auth()->user()->ads()->get();

        $adInputLabels = [];
        $adInputDescriptions = [];
        foreach ($adTypeKeys as $key) {
            foreach ($fieldIds as $id) {
                $adInputLabels[$key . $id] = __($key . '.' . $id);
                $adInputDescriptions[$key . $id] = __($key . '.' . $id . '_description');
            }
        }
        return view('create_ad', ['relatedAds' => $relatedAds, 'adTypeKeys' => $adTypeKeys, 'adInputLabels' => $adInputLabels, 'adInputDescriptions' => $adInputDescriptions, 'fieldIds' => $fieldIds]);
    }

    public function store(StoreAdRequest $request): RedirectResponse|View
    {
        $request->validated();
        $ad = Ad::create([
            'user_id' => Auth::user()->id,
            'name' => $request->ad_name,
            'price' => $request->ad_price,
            'description' => $request->ad_description,
            'type' => $request->enum('ad_type', AdTypesEnum::class),
        ]);
        if ($request->hasFile('ad_images')) {
            $images = $request->file('ad_images');
            $images = is_array($images) ? $images : [$images];
            $imageUrls = [];
            $i = 1;
            foreach ($images as $image) {
                $imageUrls[] = $image->storeAs('public/ad_images', $ad->id . '-' . $i . '.' . $image->extension());
                $i++;
            }
            $ad->images = $imageUrls;
            $ad->save();
        }
        if ($request->relatedAds) {
            foreach ($request->relatedAds as $relatedAd) {
                $ad->relatedAds()->attach($relatedAd);
            }
        }
        return redirect()->route('ad', $ad->id);
    }

    public function show(int $id)
    {
        $ad = Ad::find($id);
        if (!$ad) {
            abort(404, 'Ad not found');
        }
        return view('ad', ['ad' => $ad]);
    }

    public function list()
    {
        $ads = Ad::all();
        return view('ad_list', ['ads' => $ads]);
    }
}
