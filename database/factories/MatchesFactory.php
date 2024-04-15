<?php

namespace Database\Factories;

use App\Enums\api\v1\Matches\MatchStatus;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Match>
 */
class MatchesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'start_date' => $this->faker->dateTimeBetween('now', '+1 month'),
            'status' => MatchStatus::SCHEDULED,
            'location' => $this->faker->city,
            'result' => null,
        ];
    }
}
