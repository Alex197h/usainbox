<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\ShippingOffer;
use App\User;

class ShippingOfferSeeder extends Seeder{
    public function run(){
        $faker = Faker::create();
        $users = User::all()->pluck('id')->toArray();
        
        for($i = 0; $i < 50; $i++) {
            ShippingOffer::create([
                'description' => $faker->paragraph,
                'max_length' => $faker->numberBetween(5, 100),
                'max_width' => $faker->numberBetween(5, 100),
                'max_height' => $faker->numberBetween(5, 100),
                'max_weight' => $faker->numberBetween(1, 40),
                'max_price' => $faker->numberBetween(3, 50),
                'fixed_date' => $faker->dateTimeBetween($startDate = 'now', $endDate = '+7 days', $timezone = date_default_timezone_get()),
                'fixed_hour' => $faker->time,
                'user_shipping_id' => !empty($users) ? $faker->randomElement($users) : 0,
            ]);
        }
    }
}
