<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransportStep extends Model {
    public $timestamps = false;
    
    public function transportOffer(){
        return $this->belongsTo('App\TransportOffer');
    }
}
