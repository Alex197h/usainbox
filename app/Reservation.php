<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model {
    public function transporter(){
        return $this->belongsTo('App\User');
    }

    public function shipper(){
        return $this->belongsTo('App\User');
    }

    public function shippingOffer(){
        return $this->belongsTo('App\ShippingOffer');
    }

    public function transportOffer(){
        return $this->belongsTo('App\TransportOffer');
    }

    public function isTransporter($user_id){
        return $this->transporter_id == $user_id;
    }

    public function isShipper($user_id){
        return $this->shipper_id == $user_id;
    }
}
