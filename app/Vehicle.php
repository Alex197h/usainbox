<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model {
    public function user(){
        return $this->belongsTo('App\User');
    }
    
    public function transportOffer(){
        return $this->hasMany('App\TransportOffer');
    }
    
    public function typeVehicle(){
        return $this->belongsTo('App\TypeVehicle');
    }
    
    public function setDefault(){
        $vehicles = $this->user->vehicles();
        $vehicles->where('default', 1)->update(['default' => 0]);
        $this->default = 1;
    }
}
