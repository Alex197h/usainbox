<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model {
    public function user(){
        return $this->belongsTo('App\User');
    }
    
    public function shippingOffer(){
        return $this->belongsTo('App\ShippingOffer');
    }
    
    public function transportOffer(){
        return $this->belongsTo('App\TransportOffer');
    }
}
