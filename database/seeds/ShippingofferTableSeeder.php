<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\ShippingOffer;
use App\User;

class UsersSeeder extends Seeder{
    public function run(){
        $faker = Faker::create();

        for ($i = 0; $i < 50; $i++) {
            User::create([
                'description' => $faker->paragraph,
                'max_length' => $faker->numberBetween($min = 5, $max = 100),
                'max_width' => $faker->numberBetween($min = 5, $max = 100),
                'max_height' => $faker->numberBetween($min = 5, $max = 100),
                'max_weight' => $faker->numberBetween($min = 1, $max = 40),
                'max_price' => $faker->numberBetween($min = 3, $max = 50),
                'fixed_date' => $faker->dateTimeBetween($format = 'Y-m-d', $startDate = 'now', $endDate = '+7 days', $timezone = date_default_timezone_get())
                'fixed_hour' => $faker->time,
                'user_shipping_id' => User::all()->random()->id;
            ]);
        }
    }
}
