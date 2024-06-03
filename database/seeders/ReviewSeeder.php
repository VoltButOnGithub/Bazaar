<?php

namespace Database\Seeders;

use App\Models\Ad;
use App\Models\Review;
use App\Models\User;
use Illuminate\Database\Seeder;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (Ad::all() as $ad) {
            Review::factory()->create([
                'ad_id' => $ad->id,
                'reviewer_id' => User::whereNot('id', $ad->user->id)->first()->id,
            ]);
        }

        $users = User::inRandomOrder()->get();
        Review::factory()->create([
            'reviewer_id' => $users[0]->id,
            'user_id' => $users[1]->id,
        ]);
    }
}
