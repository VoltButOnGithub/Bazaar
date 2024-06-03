<?php

namespace Database\Seeders;

use App\Enum\UserTypesEnum;
use App\Models\Business;
use App\Models\User;
use Illuminate\Database\Seeder;

class BusinessSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (User::where('type', UserTypesEnum::BUSINESS)->get() as $user) {
            Business::factory()->create([
                'user_id' => $user->id,
                'url' => $user->name,
            ]);
        }
    }
}
