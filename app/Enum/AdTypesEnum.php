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

    public function getBuyAction(): ?string
    {
        return match ($this) {
            self::SALE => __('global.sale_buy'),
            self::AUCTION => __('global.auction_buy'),
            self::RENTAL => __('global.rental_buy'),
        };
    }

    public function getPriceLabel(float $price): ?string
    {
        return match ($this) {
            self::SALE => __('global.sale_price', ['price' => $price]),
            self::AUCTION => __('global.auction_price', ['price' => $price]),
            self::RENTAL => __('global.rental_price', ['price' => $price]),
        };
    }

    public function getIcon(): ?string
    {
        return match ($this) {
            self::SALE => 'heroicon-s-currency-euro',
            self::AUCTION => 'heroicon-s-megaphone',
            self::RENTAL => 'heroicon-s-calendar',
        };
    }

    public static function getKeys(): ?array
    {
        return array_map(fn (AdtypesEnum $adType) => strtolower($adType->name), \App\Enum\AdTypesEnum::cases());
    }
}
