<?php

namespace App\Models;

use App\Enum\UserTypesEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'username',
        'password',
        'type',
        'image',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'password' => 'hashed',
        'type' => UserTypesEnum::class,
    ];

    public function ads(): HasMany
    {
        return $this->hasMany(Ad::class);
    }

    public function favourites(): BelongsToMany
    {
        return $this->belongsToMany(Ad::class, 'favourites' ,'user_id', 'ad_id');
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    public function writtenReviews(): HasMany
    {
        return $this->hasMany(Review::class, 'reviewer_id');
    }

    public function leases(): HasMany
    {
        return $this->hasMany(Lease::class);
    }

    public function hasFavourited(int $id): bool 
    {
        return $this->favourites()->where('ad_id', $id)->exists();
    }
    
    public function hasReviewed(int $id, string $type): bool 
    {
        return $this->writtenReviews()->where($type.'_id', $id)->exists();
    }

    public function getReviewOn(int $id, string $type): Review
    {
        return $this->writtenReviews()->where($type.'_id', $id)->first();
    }

    public function getRatingAttribute(): float
    {
        if(!$this->reviews()->exists()) {
            return 0;
        }
        return round($this->reviews()->avg('stars'), 1);
    }

    public function getReviewAmountAttribute(): int
    {
        return round($this->reviews()->count());
    }
}
