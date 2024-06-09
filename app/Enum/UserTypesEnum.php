<?php

namespace App\Enum;

enum UserTypesEnum: int
{
    case INDIVIDUAL = 0;
    case INDIVIDUAL_ADVERTISER = 1;
    case BUSINESS = 2;
    case ADMIN = 3;

    public static function getCases()
    {
        $allCases = self::cases();
        return array_filter($allCases, function ($case) {
            return $case !== self::ADMIN;
        });
    }

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

    public function isAdmin(): bool
    {
        return $this === self::ADMIN;
    }

    public function getLabel(): ?string
    {
        return match ($this) {
            self::BUSINESS => __('global.business'),
            self::INDIVIDUAL => __('global.individual'),
            self::INDIVIDUAL_ADVERTISER => __('global.individual_advertiser'),
            self::ADMIN => __('global.admin'),
        };
    }

    public function getDescription(): ?string
    {
        return match ($this) {
            self::BUSINESS => __('global.business_description'),
            self::INDIVIDUAL => __('global.individual_description'),
            self::INDIVIDUAL_ADVERTISER => __('global.individual_advertiser_description'),
            self::ADMIN => __('global.admin_description'),
        };
    }

    public function getIcon(): ?string
    {
        return match ($this) {
            self::BUSINESS => 'heroicon-s-building-storefront',
            self::INDIVIDUAL => 'heroicon-s-user',
            self::INDIVIDUAL_ADVERTISER => 'heroicon-s-megaphone',
            self::ADMIN => 'heroicon-s-user-plus',
        };
    }
}
