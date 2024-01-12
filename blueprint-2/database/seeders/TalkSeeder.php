<?php

namespace Database\Seeders;

use App\Models\Talk;
use Illuminate\Database\Seeder;

class TalkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Talk::factory()->count(5)->create();
    }
}
