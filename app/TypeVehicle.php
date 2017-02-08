<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TypeVehicle extends Model {
    public $timestamps = false;
    
    public function vehicules(){
        return $this->hasMany('App\Vehicule');
    }
}
