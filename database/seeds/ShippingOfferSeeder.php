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
            $price = $faker->numberBetween(-20, 250);
            if($price <= 0) $price = null;
            
            $note = $faker->numberBetween(-20, 10);
            if($note <= 0) $note = null;
            
            ShippingOffer::create([
                'description' => $faker->paragraph,
                'max_length' => $faker->numberBetween(5, 100),
                'max_width' => $faker->numberBetween(5, 100),
                'max_height' => $faker->numberBetween(5, 100),
                'max_weight' => $faker->numberBetween(1, 40),
                'max_price' => $faker->numberBetween(3, 50),
                'fixed_price' => $price,
                'carrier_note' => $note,
                'carrier_notice' => $note != null ? $faker->sentence : null,
                'fixed_date' => $faker->dateTimeBetween($startDate = 'now', $endDate = '+7 days', $timezone = date_default_timezone_get()),
                'fixed_hour' => $faker->time,
                'user_id' => !empty($users) ? $faker->randomElement($users) : 0,
            ]);
        }
    }
}
