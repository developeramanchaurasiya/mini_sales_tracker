<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\User;
use App\Models\Service;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class OrderSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();
        $userIds = User::pluck('id')->toArray();
        $serviceIds = Service::pluck('id')->toArray();

        for ($i = 0; $i < 20000; $i++) {
            $service = Service::find($faker->randomElement($serviceIds));
            $quantity = $faker->numberBetween(1, 10);
            $totalAmount = $quantity * $service->price;

            Order::create([
                'user_id' => $faker->randomElement($userIds),
                'service_id' => $service->id,
                'quantity' => $quantity,
                'total_amount' => $totalAmount,
                'status' => $faker->randomElement(['paid', 'pending']),
                'created_at' => $faker->dateTimeBetween('-1 year', 'now'),
            ]);
        }
    }
}
