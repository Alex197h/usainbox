<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransportOffer extends Model {
    public function vehicle(){
        return $this->belongsTo('App\Vehicle');
    }

    public function reservations(){
        return $this->hasMany('App\Reservation');
    }

    public function questions(){
        return $this->hasMany('App\Question');
    }

    public function steps(){
        return $this->hasMany('App\TransportStep');
    }
    
    public function getVolumeAttribute(){
        return $this->max_volume == 0 ? $this->max_width * $this->max_length * $this->max_height : $this->max_volume;
    }
}
