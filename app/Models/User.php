<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'full_name',
        'email',
        'status',
        'password',
        'phone_number',
        'photo',
        'about_me'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function addresses(): MorphOne
    {
        return $this->morphOne(Address::class, 'addressable')->latestOfMany();
    }

    public function teams(): BelongsToMany
    {
        return $this->belongsToMany(Team::class, 'team_player')
            ->using(TeamPlayer::class)
            ->withPivot(['is_owner'])
            ->withTimestamps();
    }

    public function ownTeams(): BelongsToMany
    {
        return $this->belongsToMany(Team::class, 'team_player')
            ->using(TeamPlayer::class)
            ->wherePivot('is_owner', true)
            ->withPivot(['is_owner'])
            ->withTimestamps();
    }

    public function matches(): BelongsToMany
    {
        return $this->belongsToMany(
            Matches::class,
            'match_player',
            'player_id',
            'match_id'
        )->using(MatchPlayer::class)
        /** you can use wherePivot to filter if he is accepted */
        ->withPivot(['score', 'has_accepted_match', 'deleted_at'])->withTimestamps();
    }
}
