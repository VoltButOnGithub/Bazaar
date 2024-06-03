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
}
