<?php

use App\Models\Matches;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('match_player', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Matches::class, 'match_id')
                ->constrained()
                ->onDelete('cascade');

            $table->foreignIdFor(User::class, 'player_id')
                ->constrained()
                ->on('users')
                ->onDelete('cascade');

            $table->integer('score')->default(0);
            $table->boolean('has_accepted_match')->default(false);

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('match_player');
    }
};
