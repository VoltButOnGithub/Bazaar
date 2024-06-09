<?php

namespace App\Http\Controllers;

use App\Enum\AdTypesEnum;
use App\Http\Requests\StoreAdRequest;
use App\Models\Ad;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class AdController extends Controller
{
    public function create(): View|RedirectResponse
    {
        if (! auth()->check()) {
            return redirect('login');
        }
        $adTypeKeys = AdTypesEnum::getKeys();
        $fieldIds = ['name', 'description', 'price', 'image'];

        $relatedAds = auth()->user()->ads()->get();

        $adInputLabels = [];
        $adInputDescriptions = [];
        foreach ($adTypeKeys as $key) {
            foreach ($fieldIds as $id) {
                $adInputLabels[$key.$id] = __($key.'.'.$id);
                $adInputDescriptions[$key.$id] = __($key.'.'.$id.'_description');
            }
        }

        return view('ad.create', ['relatedAds' => $relatedAds, 'adTypeKeys' => $adTypeKeys, 'adInputLabels' => $adInputLabels, 'adInputDescriptions' => $adInputDescriptions, 'fieldIds' => $fieldIds]);
    }

    public function store(StoreAdRequest $request): RedirectResponse|View
    {
        $request->validated();
        $user = Auth::user();
        $ad_type = $request->enum('ad_type', AdTypesEnum::class);
        if($user->ads()->where('type', $ad_type)->count() > 4) {
            return redirect()->back()->withErrors(['ad_type'=> __('global.max_ads_of_type', ['type' => $ad_type->getLabel()])]);
        }
        $ad = Ad::create([
            'user_id' => $user->id,
            'name' => $request->ad_name,
            'price' => $request->ad_price,
            'description' => $request->ad_description,
            'type' => $ad_type,
        ]);
        if ($request->hasFile('ad_images')) {
            $images = $request->file('ad_images');
            $images = is_array($images) ? $images : [$images];
            $imageUrls = [];
            $i = 1;
            foreach ($images as $image) {
                $imageUrls[] = $image->storeAs('public/ad_images', $ad->id.'-'.$i.'.'.$image->extension());
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

        return redirect()->route('ad.show', $ad->id)->with('success', __('global.ad_stored'));
    }

    public function show(int $id)
    {
        $ad = Ad::find($id);
        if (! $ad) {
            abort(404, __('global.ad_not_found'));
        }
        session(['url.intended' => url()->previous()]);
        $reviews = $ad->reviews()->orderBy('updated_at', 'desc')->simplePaginate(3, ['*'], 'reviewPage');
        if (! $ad) {
            abort(404, __('global.ad_not_found'));
        }

        return view('ad.details', ['ad' => $ad, 'reviews' => $reviews]);
    }

    public function destroy(int $id): RedirectResponse
    {
        Ad::find($id)->delete();

        return redirect()->intended('/')->with('success', __('global.ad_destroyed'));
    }

    public function getQr(int $id)
    {
        $qrCode = QrCode::size(300)->generate(route('ad.show', ['ad' => $id]));

        return view('ad.qr', ['qrCode' => $qrCode, 'id' => $id]);
    }

    public function index(Request $request): View
    {
        $query = Ad::whereNull('buyer_id');
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

        return view('ad.index', [
            'ads' => $query->paginate(8),
            'ad_type' => $ad_type,
        ]);
    }
}
