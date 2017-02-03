<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
  public function shippingOffer(){
    return $this->belongsTo('App\ShippingOffer');
  }
}
