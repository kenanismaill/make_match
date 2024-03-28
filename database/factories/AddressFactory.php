<?php

namespace Database\Factories;

use App\Models\Address;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Address>
 */
class AddressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $users = User::all()->shuffle();
        $user = $users->first();

        return [
            'street' => $this->faker->streetAddress(),
            'city' => $this->faker->city(),
            'state' => $this->faker->streetName(),
            'country' => $this->faker->country(),
            'postal_code' => $this->faker->postcode(),
            'addressable_id' => $user->id,
            'addressable_type' => User::class,
        ];
    }
}
