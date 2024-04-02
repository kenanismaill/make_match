<?php

namespace Database\Seeders;

use App\Models\Address;
use App\Models\Stadium;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StadiumSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Stadium::factory()->count(10)->create()->each(function ($stadium) {
            // Create an address for each stadium and associate it
            $address = Address::factory()->create();
            $stadium->address()->save($address);
        });
    }
}
