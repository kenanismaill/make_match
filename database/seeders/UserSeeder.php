<?php

namespace Database\Seeders;

use App\Enums\api\v1\UserType;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /** add 10 default users to database */
        User::factory()->count(10)->create();

        /** create own users */
        User::query()->create([
            'full_name' => 'kenan ismail',
            'email' => 'kenanheso@gmail.com',
            'status' => UserType::ADMIN,
            'email_verified_at' => now(),
            'password' => Hash::make('kenan-2015'),
            'remember_token' => Str::random(10),
        ]);
    }
}
