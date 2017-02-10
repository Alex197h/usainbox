<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\User;

class UsersSeeder extends Seeder{
    public function run(){
        $faker = Faker::create();
        
        for ($i = 0; $i < 50; $i++) {
            User::create([
                'first_name' => $faker->firstName,
                'last_name' => $faker->lastName,
                'email' => $faker->unique()->email,
                'password' => bcrypt('password'),
                'gender' => $faker->boolean,
                'birthday' => $faker->date('Y-m-d H:i:s'),
                'phone' => $faker->e164PhoneNumber,
                'description' => $faker->paragraph,
                'help_charge' => $faker->boolean,
            ]);
        }
    }
}
