<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model {
    public function shippingOffer(){
        return $this->belongsTo('App\ShippingOffer');
    }

    public function transportOffer(){
        return $this->belongsTo('App\TransportOffer');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }
}
