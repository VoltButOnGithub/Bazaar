<?php

namespace App\Enum;

enum UserTypesEnum: int
{
    case BUSINESS = 0;
    case INDIVIDUAL = 1;
    case INDIVIDUAL_ADVERTISER = 2;

    public function isBusiness(): bool
    {
        return $this === self::BUSINESS;
    }

    public function isIndividual(): bool
    {
        return $this === self::INDIVIDUAL;
    }

    public function isIndividualAdvertiser(): bool
    {
        return $this === self::INDIVIDUAL_ADVERTISER;
    }
}
