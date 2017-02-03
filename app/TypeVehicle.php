<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TypeVehicle extends Model {
    public function vehicules(){
        return $this->hasMany('App\Vehicule');
    }
}
