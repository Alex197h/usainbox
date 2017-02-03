<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransportOffer extends Model {
    public function vehicule(){
        return $this->belongsTo('App\Vehicule');
    }

    public function reservations(){
        return $this->hasMany('App\Reservation');
    }

    public function questions(){
        return $this->hasMany('App\Question');
    }

    public function steps(){
        return $this->hasMany('App\Step');
    }
}
