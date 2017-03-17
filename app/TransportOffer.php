<?php

namespace App;

use App\Reservation;
use Illuminate\Database\Eloquent\Model;

class TransportOffer extends Model {
    public function getNoteAttribute(){
        $note = Reservation::where('transport_offer_id', $this->id)->avg('shipping_note');
        return round($note,1) ?: 0;
    }

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

    public function getUserAttribute(){
        return $this->vehicle->user;
    }

    public function getVolumeAttribute(){
        return $this->max_volume == 0 ? $this->max_width * $this->max_length * $this->max_height : $this->max_volume;
    }

    public function getReviewsAttribute(){
        return Reservation::where('transport_offer_id', $this->id)->whereNotNull('shipping_review')
            ->select('shipping_review as review', 'shipping_note as note')->limit(5)->inRandomOrder()->get();
    }
}
