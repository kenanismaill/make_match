<?php

namespace App\Jobs\api\v1\Match;

use App\Models\Matches;
use App\Models\MatchTeam;
use App\Models\User;
use App\Notifications\api\v1\Match\CreateMatchNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Notification;

class CreateMatchJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    /**
     * Create a new job instance.
     */
    public function __construct(
        public User $user,
        public int $matchId,
        public int $homeTeamId,
        public int $awayTeamId
    )
    {
        $this->afterCommit();
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        /** @var Matches $match */
        $match = Matches::query()->find($this->matchId);

        /** @var MatchTeam $matchTeam */
        $matchTeam  = MatchTeam::query()->create([
            'match_id' => $this->matchId,
            'home_team' => $this->homeTeamId,
            'away_team' => $this->awayTeamId
        ]);

        $homeTeamPlayers = $matchTeam->homeTeam->players->pluck('id')->toArray();
        $awayTeamPlayers = $matchTeam->awayTeam->players->pluck('id')->toArray();
        $match->players()->sync(array_values(array_diff($homeTeamPlayers, $awayTeamPlayers)));
        Notification::send($this->user,new CreateMatchNotification());
    }

    /**
     * Determine number of times the job may be attempted.
     */
    public function tries(): int
    {
        return 1;
    }
}
