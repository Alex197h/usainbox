<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\TransportOffer;
use App\Vehicle;

class TransportOffersController extends Controller {
    public function index(){
        // var_dump(Vehicle::where('id', '1'));
        
        /**
            Si !date_start passée ou !full
        */
        
        $offers = TransportOffer::all();

        $city_steps = array();
        foreach ($offers as $offer){

            $steps = $offer->steps;
            foreach ($steps as $step){
                $geocode=file_get_contents('http://maps.googleapis.com/maps/api/geocode/json?latlng='. $step['latitude'] .','. $step['longitude'] .'&sensor=false');

                $output= json_decode($geocode);

                if(isset($output->results[0])){
                    $city_steps[$offer->id][$step->step] = $output->results[0]->address_components[1]->long_name;
                }
            }
        }

        $data = array(
            'offers' => $offers,
            'steps' => $city_steps
        );
        return view('front.transport.list', $data);
    }
}
