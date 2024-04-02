<?php

namespace Database\Factories;

use App\Enums\api\v1\Stadium\StadiumStatus;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Stadium>
 */
class StadiumFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $openingTime = Carbon::createFromTime(8, 0, 0); // Opening time at 8:00 AM
        $closingTime = Carbon::createFromTime(24, 0, 0); // Assuming the stadium closes at 24:00 PM daily

        return [
            'name' => $this->faker->unique()->word,
            'capacity' => $this->faker->randomElement([6, 12]),
            'status' => StadiumStatus::UNDER_REVIEW,
            'location' => $this->faker->address,
            'description' => $this->faker->paragraph,
            'contact_number' => $this->faker->phoneNumber,
            'email' => $this->faker->email,
            'website' => $this->faker->url,
            'owner' => $this->faker->name,
            'surface_type' => $this->faker->randomElement(['Grass', 'Turf', 'Artificial']),
            'opening_time' => $openingTime->format('H:i:s'),
            'closing_time' => $closingTime->format('H:i:s'),
            'architect' => $this->faker->name,
            'seating_details' => $this->faker->text,
            'amenities' => $this->faker->text,
            'accessibility_features' => $this->faker->text,
            'social_media_links' => $this->faker->url,
        ];
    }
}
