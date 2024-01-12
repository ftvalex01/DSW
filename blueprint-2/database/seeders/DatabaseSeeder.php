<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Conference;
use App\Models\Venue;
use App\Models\Speaker;
use App\Models\Talk;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        
        Conference::factory(10)->create();
        Venue::factory(10)->create();
        Speaker::factory(10)->create();
        Talk::factory(10)->create();

    }
}
