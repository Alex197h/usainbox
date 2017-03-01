<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\TransportOffer;
use App\TransportStep;
use App\Vehicle;
use App\TypeVehicle;
use Auth;

class TransportOffersController extends Controller {
    public function index(){
        return redirect()->route('home');
    }

    public function create(){
        $auth = Auth::user();
        $vehicles = $auth->vehicles;
        if($vehicles == '[]'){
            $types = TypeVehicle::all();
            $data = array(
                'type_vehicles' => $types
            );
            return view('user.vehicles', $data);
        }
        return view('front.transport.create', $data);
    }

    public function search(Request $request){
        if ($request->input('city_start') != "") {
            $infoPositionStart = str_replace(", ", '+',$request->input('city_start'));
            $geocodeStart=file_get_contents('http://maps.googleapis.com/maps/api/geocode/json?address='.$infoPositionStart.'&sensor=false');
            $outputStart= json_decode($geocodeStart);
            if(isset($outputStart->results[0])){
                $start_city = $outputStart->results[0]->geometry->location;
            }
        }
        else{
            $start_city = "";
        }

        if ($request->input('city_end') != "") {
            $infoPositionEnd = str_replace(", ", '+',$request->input('city_end'));
            $geocodeEnd=file_get_contents('http://maps.googleapis.com/maps/api/geocode/json?address='.$infoPositionEnd.'&sensor=false');
            $outputEnd= json_decode($geocodeEnd);
            if(isset($outputEnd->results[0])){
                $end_city = $outputEnd->results[0]->geometry->location;
            }
        }
        else{
            $end_city = "";
        }

        $earthRadius = 6371000;
        $min_new_lat_start =  $start_city->lat - ( 5000 / $earthRadius) * (180/pi());
        $min_new_lng_start =  $start_city->lng - ( 5000 / $earthRadius) * (180/pi()) / cos($start_city->lat * pi() / 180);
        $plus_new_lat_start =  $start_city->lat + ( 5000 / $earthRadius) * (180/pi());
        $plus_new_lng_start =  $start_city->lng + ( 5000 / $earthRadius) * (180/pi()) / cos($start_city->lat * pi() / 180);
        $start_area = array($min_new_lat_start, $min_new_lng_start, $plus_new_lat_start, $plus_new_lng_start);

        $min_new_lat_end =  $end_city->lat - ( 5000 / $earthRadius) * (180/pi());
        $min_new_lng_end =  $end_city->lng - ( 5000 / $earthRadius) * (180/pi()) / cos($end_city->lat * pi() / 180);
        $plus_new_lat_end =  $end_city->lat + ( 5000 / $earthRadius) * (180/pi());
        $plus_new_lng_end =  $end_city->lng + ( 5000 / $earthRadius) * (180/pi()) / cos($end_city->lat * pi() / 180);
        $end_area = array($min_new_lat_end, $min_new_lng_end, $plus_new_lat_end, $plus_new_lng_end);


        $offers = DB::select(
            'SELECT transport_offer_id
            FROM transport_steps tr
                WHERE longitude >= :long_start_min
                AND longitude <= :long_start_max
                AND latitude >= :lat_start_min
                AND latitude <= :lat_start_max
            AND transport_offer_id IN (
                SELECT transport_offer_id
                FROM transport_steps td
                WHERE longitude >= :long_end_min
                AND longitude <= :long_end_max
                AND latitude >= :lat_end_min
                AND latitude <= :lat_end_max
                AND tr.step <= td.step
            )',
            [
                'long_start_min' => $start_area[1],
                'long_start_max' => $start_area[3],
                'lat_start_min' => $start_area[0],
                'lat_start_max' => $start_area[2],
                'long_end_min' => $end_area[1],
                'long_end_max' => $end_area[3],
                'lat_end_min' => $end_area[0],
                'lat_end_max' => $end_area[2],
            ]
        );


        $results = array();
        foreach($offers as $offer){
            $results[] = $offer->transport_offer_id;
        }

        $view_offers = TransportOffer::whereIn('id', $results)->where('date_start', '>=', $request->input('date'))->get();

        $city_steps = array();
        foreach ($view_offers as $view_offer){

            $steps = $view_offer->steps;
            foreach ($steps as $step){
                $geocode=file_get_contents('http://maps.googleapis.com/maps/api/geocode/json?latlng='. $step['latitude'] .','. $step['longitude'] .'&sensor=false');

                $output= json_decode($geocode);

                if(isset($output->results[0])){
                    $city_steps[$view_offer->id][$step->step] = $output->results[0]->address_components[1]->long_name;
                }
            }
        }


        return view('front.transport.list', ['offers' => $view_offers, 'steps' => $city_steps]);
    }


}
