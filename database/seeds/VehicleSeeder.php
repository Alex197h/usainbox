<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\TypeVehicle;
use App\User;
use App\Vehicle;

class VehicleSeeder extends Seeder{
    public function run(){
        // $faker = Faker::create();
        
        // $Users = User::all()->pluck('id')->toArray();
        // $TypesVehicle = App\TypeVehicle::all()->pluck('id')->toArray();
        
        // for($i = 0; $i < 50; $i++) {
            // $weight = $faker->numberBetween(-20, 20);
            // if($weight < 0) $weight = null;
        
            // $volume = $faker->numberBetween(-5, 15);
            // if($volume < 0){
                // $volume = 0;
                // $width = $faker->randomFloat(2, 1, 20);
                // $height = $faker->randomFloat(2, 1, $width*2);
                // $length = $faker->randomFloat(2, 1, $width);
            // } else {$width = 0; $height = 0; $length = 0;}
        
            // Vehicle::create([
                // 'default' => $faker->boolean,
                // 'max_width' => $width,
                // 'max_length' => $length,
                // 'max_height' => $height,
                // 'max_volume' => $volume,
                // 'max_weight' => $weight,
                // 'car_brand' => $faker->word,
                // 'car_model' => $faker->regexify('[A-Z][a-z]{4,8} [0-9]{3,4}'),
                // 'user_id' => !empty($Users) ? $faker->randomElement($Users) : 0,
                // 'type_vehicle_id' => !empty($TypesVehicle) ? $faker->randomElement($TypesVehicle) : 0,
            // ]);
        // }
    }
}
