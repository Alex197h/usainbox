<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Vehicle;

class User extends Authenticatable {
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'first_name', 'last_name', 'gender', 'birthday', 'phone', 'avatar',
        'social_id', 'provider', 'help_charge', 'is_admin', 'description'
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
    
    
    
    public function getIsTransporterAttribute(){
        return Vehicle::where('user_id', $this->id)->first() != NULL;
    }

    public function notation(){

        $transport_offers = TransportOffer::where('user_id', $this->id)->get();
        return Reservation::whereIn('user_id', $transport_offers)->avg();
    }
}
