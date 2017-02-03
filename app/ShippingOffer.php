<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShippingOffer extends Model {
    public function user(){
        return $this->belongsTo('App\User');
    }
    
    public function reservations(){
        return $this->belongsTo('App\Reservation');
    }
    
    public function questions(){
        return $this->hasMany('App\Question');
    }
}
