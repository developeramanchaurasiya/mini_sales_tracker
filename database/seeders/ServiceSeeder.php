<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ServiceSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();
        for ($i = 0; $i < 20; $i++) {
            Service::create([
                'name' => $faker->word,
                'price' => $faker->randomFloat(2, 10, 500),
            ]);
        }
    }
}

