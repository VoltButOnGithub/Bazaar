<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\AdResource;
use App\Models\Ad;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class AdApiController extends Controller
{
    public function ads(Request $request)
    {
        $ads = Ad::where('user_id', auth()->user()->id)->get();

        return AdResource::collection($ads);
    }

    public function ad(int $id)
    {
        $ad = Ad::find($id);
        if(!auth()->user()->isOwnerOf($id)) {
            return response(403);
        }
        return new AdResource($ad);
    }
}
