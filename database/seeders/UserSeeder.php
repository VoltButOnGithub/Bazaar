<?php

namespace Database\Seeders;

use App\Enum\UserTypesEnum;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Business',
            'username' => 'Business',
            'password' => Hash::make('password'),
            'type' => UserTypesEnum::BUSINESS,
        ]);

        User::factory()->create([
            'name' => 'Individual',
            'username' => 'Individual',
            'password' => Hash::make('password'),
            'type' => UserTypesEnum::INDIVIDUAL,
        ]);

        User::factory()->create([
            'name' => 'Advertiser',
            'username' => 'Advertiser',
            'password' => Hash::make('password'),
            'type' => UserTypesEnum::INDIVIDUAL_ADVERTISER,
        ]);
    }
}
