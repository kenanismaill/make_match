<?php

namespace Database\Factories;

use App\Enums\api\v1\Team\TeamType;
use App\Enums\api\v1\TestEnum;
use App\Enums\api\v1\User\UserType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Team>
 */
class TeamFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'type' => $this->faker->randomElement(TeamType::cases()),
        ];
    }
}
