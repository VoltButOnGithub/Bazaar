<?php

namespace Database\Seeders;

use App\Enum\AdTypesEnum;
use App\Models\Ad;
use App\Models\Lease;
use App\Models\User;
use Illuminate\Database\Seeder;

class LeaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (Ad::where('type', AdTypesEnum::RENTAL)->get() as $ad) {
            Lease::factory()->create([
                'ad_id' => $ad->id,
                'user_id' => User::whereNot('id', $ad->user->id)->first()->id,
            ]);
        }
    }
}
