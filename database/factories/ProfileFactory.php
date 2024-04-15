<?php

namespace Database\Factories;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Profile>
 */
class ProfileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => null,
            'birth_date' => $this->faker->date(),
            'phone_number' => $this->faker->phoneNumber(),
            'photo' => $this->faker->imageUrl(),
            'about_me' => $this->faker->text(100),
        ];
    }

    public function configure(): ProfileFactory|Factory
    {
        $users = User::all();

        return $this->afterCreating(function (Profile $profile) use ($users) {
            $index = $profile->id % count($users);
            $profile->user()->associate($users[$index]);
            $profile->save();
        });
    }
}
