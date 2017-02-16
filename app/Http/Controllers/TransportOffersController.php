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

class TransportOffersController extends Controller {
    public function index(){
        // var_dump(Vehicle::where('id', '1'));


            // Si !date_start passée ou !full
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


      $offers = TransportStep::select('transport_offer_id')->where(function ($query) use($start_area, $end_area){
            $query->where('longitude', '>', $start_area[1])
                ->where('longitude', '<', $start_area[3])
                ->where('latitude', '>', $start_area[0])
                ->where('latitude', '<', $start_area[2]);
        })->orWhere(function ($query) use($start_area, $end_area){
            $query->where('longitude', '>', $end_area[1])
                ->where('longitude', '<', $end_area[3])
                ->where('latitude', '>', $end_area[0])
                ->where('latitude', '<', $end_area[2]);
        })->groupBy("transport_offer_id")->havingRaw('COUNT(*) > 1')->where('longitude', '>', $end_area[1])
            ->where('longitude', '<', $end_area[3])
            ->where('latitude', '>', $end_area[0])
            ->where('latitude', '<', $end_area[2])->get();


      dd($start_city,$end_city, $offers);
      //$data['city_start'] = $request->input('city_start')
      //return redirect()->view('front.transport.list_trie', $data);
    }


}
