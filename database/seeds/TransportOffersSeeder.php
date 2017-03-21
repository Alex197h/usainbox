<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\TransportOffer;
use App\TransportStep;
use App\Vehicle;

class TransportOffersSeeder extends Seeder{
    public function run(){
        // $faker = Faker::create();
        
        
        // $Vehicles = Vehicle::all()->pluck('id')->toArray();
        
        // for($i = 0; $i < 20; $i++){
            // $volume = $faker->numberBetween(-5, 15);
            // if($volume < 0){
                // $volume = 0;
                // $width = $faker->randomFloat(2, 1, 20);
                // $height = $faker->randomFloat(2, 1, $width*2);
                // $length = $faker->randomFloat(2, 1, $width);
            // } else {$width = 0; $height = 0; $length = 0;}
        
            // $date = $faker->dateTimeBetween($startDate = 'now', $endDate = '+7 days', $timezone = date_default_timezone_get());
        
            // $to = TransportOffer::create([
                // 'detour' => $faker->boolean,
                // 'highway' => $faker->boolean,
                // 'is_regular' => $faker->boolean,
                // 'date_start' => $date,
                // 'max_width' => $width,
                // 'max_length' => $length,
                // 'max_height' => $height,
                // 'max_volume' => $volume,
                // 'max_weight' => $faker->randomFloat(2, 1, 20),
                // 'description' => $faker->text,
                // 'full' => $faker->boolean,
                // 'vehicle_id' => !empty($Vehicles) ? $faker->randomElement($Vehicles) : 0,
            // ]);
        
            // $n = rand(3, 5);
            // for($j = 1; $j <= $n; $j++){
                // TransportStep::create([
                    // 'transport_offer_id' => $to->id,
                    // 'longitude' => $faker->randomFloat(5, 0.637207, 4.855957),
                    // 'latitude' => $faker->randomFloat(5, 44.21371, 48.253941),
                    // 'label' => $faker->sentence,
                    // 'step' => $j,
                // ]);
            // }
        // }
    }
}
