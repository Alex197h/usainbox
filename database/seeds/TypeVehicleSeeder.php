<?php

use Illuminate\Database\Seeder;
use App\TypeVehicle;

class TypeVehicleSeeder extends Seeder{
    public function run(){
        //DB::table('type_vehicle')->delete();
        
        TypeVehicle::create(['label' => 'Voiture']);
        TypeVehicle::create(['label' => 'Camion']);
        TypeVehicle::create(['label' => 'Moto']);
        TypeVehicle::create(['label' => 'Vélo']);
        TypeVehicle::create(['label' => 'Avion']);
        TypeVehicle::create(['label' => 'Jet privé']);
        TypeVehicle::create(['label' => 'Rollers']);
        TypeVehicle::create(['label' => 'Trotinette']);
        TypeVehicle::create(['label' => 'Ambulance']);
        TypeVehicle::create(['label' => 'Barque']);
        TypeVehicle::create(['label' => 'Pédalo']);
        TypeVehicle::create(['label' => 'Bateau']);
    }
}
