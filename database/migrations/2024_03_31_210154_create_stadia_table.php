<?php

use App\Enums\api\v1\Stadium\StadiumStatus;
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
        Schema::create('stadiums', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('capacity');
            $table->boolean('status')->default(StadiumStatus::UNDER_REVIEW);
            $table->string('location')->nullable();
            $table->string('contact_number')->nullable();
            $table->string('email')->nullable();
            $table->string('website')->nullable();
            $table->string('owner')->nullable();
            $table->string('surface_type')->nullable();
            $table->time('opening_time')->nullable();
            $table->time('closing_time')->nullable();
            $table->string('architect')->nullable();
            $table->text('seating_details')->nullable();
            $table->text('description')->nullable();
            $table->text('amenities')->nullable();
            $table->text('accessibility_features')->nullable();
            $table->text('social_media_links')->nullable();

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stadiums');
    }
};
