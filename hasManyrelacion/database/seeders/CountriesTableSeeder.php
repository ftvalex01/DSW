<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use App\Models\Country;

class CountriesTableSeeder extends Seeder
{
    public function run()
    {
        
        Country::factory()->count(10)->create();
    }
}
