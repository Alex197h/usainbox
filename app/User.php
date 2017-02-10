<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable {
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'first_name', 'last_name', 'gender', 'birthday', 'phone'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function vehicles(){
        return $this->hasMany('App\Vehicle');
    }
    
    public function reservations(){
        return $this->hasMany('App\Reservation');
    }
    
    public function shipping_offers(){
        return $this->hasMany('App\ShippingOffer');
    }
    
    public function questions(){
        return $this->hasMany('App\Question');
    }
}
