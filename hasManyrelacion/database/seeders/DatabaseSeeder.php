<?php

namespace Database\Seeders;

// database/seeders/DatabaseSeeder.php

use Illuminate\Database\Seeder;
use App\Models\Country;
use App\Models\User;
use App\Models\Post;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Crea 5 países de ejemplo
        Country::factory()->count(5)->create()->each(function ($country) {
            // Para cada país, crea 10 usuarios
            $country->users()->saveMany(User::factory()->count(10)->make())->each(function ($user) {
                // Para cada usuario, crea 3 posts
                $user->posts()->saveMany(Post::factory()->count(3)->make());
            });
        });
    }
}

