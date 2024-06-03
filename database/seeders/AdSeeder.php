<?php

namespace Database\Seeders;

use App\Enum\AdTypesEnum;
use App\Models\Ad;
use App\Models\User;
use Illuminate\Database\Seeder;

class AdSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();

        $adsData = [
            [
                'type' => AdTypesEnum::SALE,
                'name' => 'Sale',
                'description' => 'Description for Sale',
                'price' => 100.00,
            ],
            [
                'type' => AdTypesEnum::AUCTION,
                'name' => 'Auction',
                'description' => 'Description for Auction',
                'price' => 150.00,
            ],
            [
                'type' => AdTypesEnum::RENTAL,
                'name' => 'Rental',
                'description' => 'Description for Rental',
                'price' => 200.00,
            ],
        ];

        foreach ($adsData as $adData) {
            $adData['user_id'] = $users->random()->id;

            Ad::create($adData);
        }
    }
}
