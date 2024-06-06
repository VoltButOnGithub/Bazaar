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

class AdController extends Controller
{
    public function create(): View|RedirectResponse
    {
        if (!auth()->check()) {
            return redirect('login');
        }
        $adTypeKeys = AdTypesEnum::getKeys();
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
        return view('ad.create', ['relatedAds' => $relatedAds, 'adTypeKeys' => $adTypeKeys, 'adInputLabels' => $adInputLabels, 'adInputDescriptions' => $adInputDescriptions, 'fieldIds' => $fieldIds]);
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
        return view('ad.details', ['ad' => $ad]);
    }

    public function index(Request $request): View
    {
        $query = Ad::query();
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
        }

        $ad_type = $request->input('ad_type', 'all');
        if ($ad_type != 'all') {
            $query->where('type', $ad_type);
        }

        return view('ad.index', [
            'ads' => $query->paginate(5),
            'ad_type' => $ad_type,
        ]);
    }
}
