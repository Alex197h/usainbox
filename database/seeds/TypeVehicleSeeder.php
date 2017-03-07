<?php

use Illuminate\Database\Seeder;
use App\TypeVehicle;

class TypeVehicleSeeder extends Seeder{
    public function run(){
        TypeVehicle::create(['label' => 'Voiture']);
        TypeVehicle::create(['label' => 'Camion']);
        TypeVehicle::create(['label' => 'Moto']);
        TypeVehicle::create(['label' => 'Vélo']);
        TypeVehicle::create(['label' => 'Avion']);
        TypeVehicle::create(['label' => 'Bateau']);
    }
}
