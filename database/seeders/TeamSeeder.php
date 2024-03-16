<?php

namespace Database\Seeders;

use App\Models\Team;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $teams = Team::factory()->count(5)->create();

        $teams->each(function ($team) {
            $users = User::query()->inRandomOrder()->take(rand(1, 6))->pluck('id')->toArray();
            $team->users()->sync($users, ['created_at' => now(), 'updated_at' => now()]);
        });
    }
}
