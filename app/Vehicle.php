<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    public function user(){
        return $this->belongsTo('App\User');
    }
    
    public function transportOffer(){
        return $this->belongsTo('App\TransportOffer');
    }
}
