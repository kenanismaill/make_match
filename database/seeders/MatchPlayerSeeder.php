<?php

namespace Database\Seeders;

use App\Models\Matches;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MatchPlayerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $matches = Matches::query()->get();
        $players = User::query()->get();

        /** @var Matches $match */
        foreach ($matches as $match) {
            $match->players()->attach($players->random(rand(1, 10))->pluck('id')->toArray(), [
                'score' => 0,
                'has_accepted_match' => false,
            ]);
        }
    }
}
