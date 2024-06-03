<?php

namespace Database\Seeders;

use App\Enum\AdTypesEnum;
use App\Models\Ad;
use App\Models\Bid;
use App\Models\User;
use Illuminate\Database\Seeder;

class BidSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (Ad::where('type', AdTypesEnum::AUCTION)->get() as $ad) {
            Bid::factory()->create([
                'ad_id' => $ad->id,
                'user_id' => User::whereNot('id', $ad->user->id)->first()->id,
            ]);
        }
    }
}
