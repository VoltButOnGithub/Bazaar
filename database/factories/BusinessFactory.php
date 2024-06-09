<?php

namespace Database\Factories;

use App\Enum\UserTypesEnum;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Business>
 */
class BusinessFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $user = User::factory()->create(['type' => UserTypesEnum::BUSINESS]);

        return [
            'user_id' => $user->id,
            'url' => $user->username,
            'primary_color' => fake()->hexColor(),
            'secondary_color' => fake()->hexColor(),
            'layout' => json_decode('{"1":[{"0":"ads","text":null},{"0":"nothing","text":null},{"0":"nothing","text":null}],"2":[{"0":"reviews","text":null},{"0":"nothing","text":null},{"0":"nothing","text":null}]}'),
        ];
    }
}
