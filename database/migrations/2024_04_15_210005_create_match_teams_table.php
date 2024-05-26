\<?php

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
        // Create the table without foreign key constraints
        Schema::create('match_team', function (Blueprint $table) {
            $table->id();
            $table->foreignId('match_id')->nullable();
            $table->foreignId('home_team')->nullable();
            $table->foreignId('away_team')->nullable();

            $table->softDeletes();
            $table->timestamps();
        });

        // Add foreign key constraints
        Schema::table('match_team', function (Blueprint $table) {
            $table->foreign('match_id')
                ->references('id')
                ->on('matches')
                ->nullOnDelete();
            $table->foreign('home_team')
                ->references('id')
                ->on('teams')
                ->nullOnDelete();
            $table->foreign('away_team')
                ->references('id')
                ->on('teams')
                ->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('match_team');
    }
};
