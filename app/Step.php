<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Step extends Model {
    public function transportOffer(){
        return $this->belongsTo('App\TransportOffer');
    }
}
