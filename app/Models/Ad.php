<?php

namespace App\Models;

use App\Enum\AdTypesEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Ad extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'type',
        'name',
        'description',
        'price',
        'images',
        'buyer_id',
    ];

    protected $casts = [
        'type' => AdTypesEnum::class,
        'name' => 'string',
        'description' => 'string',
        'price' => 'decimal:2',
        'images' => 'array',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function buyer(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    public function bids(): HasMany
    {
        return $this->hasMany(Bid::class);
    }

    public function leases(): HasMany
    {
        return $this->hasMany(Lease::class);
    }

    public function relatedAds(): BelongsToMany
    {
        return $this->belongsToMany(Ad::class, 'related_ads', 'ad_id', 'related_ad_id');
    }

    public function getRatingAttribute(): float
    {
        if (! $this->reviews()->exists()) {
            return 0;
        }

        return round($this->reviews()->avg('stars'), 1);
    }

    public function getReviewAmountAttribute(): int
    {
        return round($this->reviews()->count());
    }
}
