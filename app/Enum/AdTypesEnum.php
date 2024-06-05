<?php

namespace App\Enum;

enum AdTypesEnum: int
{
    case SALE = 0;
    case AUCTION = 1;
    case RENTAL = 2;

    public function isSale(): bool
    {
        return $this === self::SALE;
    }

    public function isAuction(): bool
    {
        return $this === self::AUCTION;
    }

    public function isRental(): bool
    {
        return $this === self::RENTAL;
    }

    public function getLabel(): ?string
    {
        return match ($this) {
            self::SALE => __('global.sale'),
            self::AUCTION => __('global.auction'),
            self::RENTAL => __('global.rental'),
        };
    }

    public function getDescription(): ?string
    {
        return match ($this) {
            self::SALE => __('global.sale_description'),
            self::AUCTION => __('global.auction_description'),
            self::RENTAL => __('global.rental_description'),
        };
    }

    public function getIcon(): ?string
    {
        return match ($this) {
            self::SALE => 'heroicon-s-building-storefront',
            self::AUCTION => 'heroicon-s-user',
            self::RENTAL => 'heroicon-s-megaphone',
        };
    }

    public static function getKeys(): ?array
    {
        return array_map(fn($adType) => strtolower($adType->name), \App\Enum\AdTypesEnum::cases());
    }
}
