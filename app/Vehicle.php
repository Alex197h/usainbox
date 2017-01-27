<?php

namespace App;

class Vehicle
{
  public function user(){
    return $this->belongsTo('App\User');
  }
}
