<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\ReviewResource;

class AdResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'user' => new UserResource($this->user),
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->when($this->type->isSale(), $this->price),
            'type' => $this->type,
            'images' => $this->images,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'related_ads' => AdResource::collection($this->relatedAds),
            $this->mergeWhen($this->type->isAuction(), [
                'highest_bid' => $this->highest_bid,
                'bids' => BidResource::collection($this->bids),
            ]),
            $this->mergeWhen($this->type->isRental(), [
                'price_per_day' => $this->price,
                'rating' => $this->rating,
                'reviews_amount' => $this->reviewAmount,
            ]),
        ];
    }
}
