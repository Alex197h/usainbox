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
        if($vehicles && $vehicles->isEmpty()){
            return redirect()->route('user_vehicles');
        }
        $data = array(
            'vehicles' => $vehicles
        );
        return view('front.transport.create', $data);
    }

    public function postCreate(Request $request){
        $rules = array(
            'start_city' => 'required|max:255',
            'end_city' => 'required|max:255',
            'vehicle' => 'required|numeric',
            'date_start' => 'date_format:Y-m-d H:i|required',
            'max_volume' => 'required|numeric',
            'max_length' => 'numeric',
            'max_width' => 'numeric',
            'max_height' => 'numeric',
            'max_weight' => 'numeric',
        );
        $this->validate($request, $rules);

        $transport = new TransportOffer();
        if ($request->has('max_width')) $transport->max_width = $request->input('max_width');
        if ($request->has('max_length')) $transport->max_length = $request->input('max_length');
        if ($request->has('max_height')) $transport->max_height = $request->input('max_height');
        if ($request->has('max_weight')) $transport->max_weight = $request->input('max_weight');
        $transport->max_volume = $request->input('max_volume');
        $transport->date_start = $request->input('date_start');

        $transport->is_regular = $request->input('is_regular') ? 1 : 0;
        $transport->highway = $request->input('highway') ? 1 : 0;
        $transport->detour = $request->input('start_detour') ? 1 : 0;
        if ($request->has('description')) $transport->description = $request->input('description');
        $transport->vehicle_id = $request->input('vehicle');
        if($transport->save()){
            $step1 = new TransportStep();
            $step1->transport_offer_id = $transport->id;
            $step1->label = $request->input('start_city');
            $infoPosition = str_replace(", ", '+',$request->input('start_city'));
            $geocode = file_get_contents('http://maps.googleapis.com/maps/api/geocode/json?address='.$infoPosition.'&sensor=false');
            $output = json_decode($geocode);
            $step1->latitude = $output->results[0]->geometry->location->lat;
            $step1->longitude = $output->results[0]->geometry->location->lng;
            $step1->step = 1;
            $tabSteps = array();
                for( $i=0; $i<sizeof($request->steps); $i++){
                    $step = new TransportStep();
                    $step->transport_offer_id = $transport->id;
                    $step->label = $request->steps[$i];
                    $infoPositionStep = str_replace(", ", '+',$request->steps[$i]);
                    $geocodeStep = file_get_contents('http://maps.googleapis.com/maps/api/geocode/json?address='.$infoPositionStep.'&sensor=false');
                    $outputStep = json_decode($geocodeStep);
                    $step->latitude = $outputStep->results[0]->geometry->location->lat;
                    $step->longitude = $outputStep->results[0]->geometry->location->lng;
                    $step->step = $i+1;
                    $tabSteps[] = $step;
                }
                $steplast = new TransportStep();
                $steplast->transport_offer_id = $transport->id;
                $steplast->label = $request->input('start_city');
                $infoPositionEnd = str_replace(", ", '+',$request->input('start_city'));
                $geocodeEnd = file_get_contents('http://maps.googleapis.com/maps/api/geocode/json?address='.$infoPositionEnd.'&sensor=false');
                $outputEnd = json_decode($geocodeEnd);
                $steplast->latitude = $outputEnd->results[0]->geometry->location->lat;
                $steplast->longitude = $outputEnd->results[0]->geometry->location->lng;
                $steplast->step = sizeof($request->steps)+1;
                $step1->save();
                foreach ($tabSteps as $onestep) {
                    $onestep->save();
                }
                $steplast->save();
                return redirect()->route('detail_transport_offer');
            }else return redirect()->back()->withInput();


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
                    $city_steps[$view_offer->id][$step->step] = $output->results[0]->address_components[2]->long_name;
                }
            }
        }


        return view('front.transport.list', ['offers' => $view_offers, 'steps' => $city_steps, 'city_start' => $request->input('city_start'), 'city_end' => $request->input('city_end')]);
    }

    public function detail(){
        return view('front.transport.detail');
    }


}
