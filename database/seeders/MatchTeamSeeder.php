<?php

namespace Database\Seeders;

use App\Models\Matches;
use App\Models\MatchTeam;
use App\Models\Team;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MatchTeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get all matches and teams
        $matches = Matches::all();
        $teams = Team::all();

        // Loop through each match and assign home and away teams
        foreach ($matches as $match) {
            // Randomly select home and away teams
            $homeTeam = $teams->random();
            $awayTeam = $teams->where('id', '!=', $homeTeam->id)->random();

            // Create match team entry
            MatchTeam::create([
                'match_id' => $match->id,
                'home_team' => $homeTeam->id,
                'away_team' => $awayTeam->id,
            ]);
        }
    }
}
