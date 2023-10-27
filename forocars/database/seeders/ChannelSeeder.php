<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Channel;

class ChannelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Channel::create([
            'title' => 'PHP',
            'slug' => 'php',
            'color' => '#FF5733',
        ]);

        Channel::create([
            'title' => 'JavaScript',
            'slug' => 'javascript',
            'color' => '#F7DF1E', 
        ]);

        Channel::create([
            'title' => 'Python',
            'slug' => 'python',
            'color' => '#3776AB', 
        ]);
    }
}
