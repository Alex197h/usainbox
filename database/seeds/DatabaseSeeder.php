<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder{
    public function run() {
        $this->call(UsersSeeder::class);
        $this->call(TypeVehicleSeeder::class);
        $this->call(VehicleSeeder::class);
        $this->call(TransportOffersSeeder::class);
        $this->call(ShippingOfferSeeder::class);
    }
}
