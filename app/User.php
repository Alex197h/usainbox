<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Vehicle;
use Storage;

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
    
    public function getAvatarPathAttribute(){
        if(!file_exists('public/img/avatar/'.$this->avatar)){
            $this->avatar = 'default.jpg';
            $this->save();
        }
        return asset('public/img/avatar/'.(($this->avatar != null) ? $this->avatar : 'default.jpg'));
    }

    public static function getAvatarPath(){
        return asset('public/img/avatar/');
    }
    
    public function getFullNameAttribute(){
        return $this->first_name.' '.$this->last_name;
    }

    public function getIsTransporterAttribute(){
        return Vehicle::where('user_id', $this->id)->first() != NULL;
    }

    public function notation(){

        $transport_offers = TransportOffer::where('user_id', $this->id)->get();
        return Reservation::whereIn('user_id', $transport_offers)->avg();
    }
}
