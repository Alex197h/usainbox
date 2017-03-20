<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ShippingOffer;
use App\TransportOffer;
use App\Notifications\Alerts;
use Auth;
use DB;

class ShippingOffersController extends Controller{
    public function index(Request $request){
        $data = array();
        $data['city_start'] = $request->input('city_start');
        $data['city_end'] = $request->input('city_end');

        return view('front.shipping.alert', $data);
    }

    public function save(Request $request){
        $rules = array(
            'city_start' => 'required',
            'city_end' => 'required',
            'date' => 'required',
            'volume' => 'numeric'
        );

        $this->validate($request, $rules);

        $auth = Auth::user();

        $alert = new ShippingOffer();

        $infoPositionStart = str_replace(' ', '+',$request->input('city_start'));
        $geocodeStart=file_get_contents('http://maps.googleapis.com/maps/api/geocode/json?address='.$infoPositionStart.'&sensor=false');
        $outputStart= json_decode($geocodeStart);
        if(isset($outputStart->results[0])){
            $start_city = $outputStart->results[0]->geometry->location;
            $alert->longitude_start = $start_city->lng;
            $alert->latitude_start = $start_city->lat;
        }else{
            return redirect()->back()->withInput()->withErrors(['city_start' => 'L\'adresse n\'est pas valide']);
        }

        $infoPositionEnd = str_replace(' ', '+',$request->input('city_end'));
        $geocodeEnd=file_get_contents('http://maps.googleapis.com/maps/api/geocode/json?address='.$infoPositionEnd.'&sensor=false');
        $outputEnd= json_decode($geocodeEnd);

        if(isset($outputEnd->results[0])){
            $end_city = $outputEnd->results[0]->geometry->location;
            $alert->longitude_end = $end_city->lng;
            $alert->latitude_end = $end_city->lat;
        }else{
            return redirect()->back()->withInput()->withErrors(['city_end' => 'L\'adresse n\'est pas valide']);
        }

        $alert->fixed_date = date('Y-m-d',strtotime($request->input('date')));
        $alert->user_id = $auth->id;
        if(!empty($request->input('libele')))
        $alert->libele = $request->input('libele');
        if(!empty($request->input('volume')))
        $alert->volume = $request->input('volume');

        if($alert->save()){
            return redirect()->route('user_profile')->with('message', 'Alerte enregistrée !');
        }else{
            return redirect()->back()->withInput();
        }


    }


    public function autoSearch(){
        $offers = ShippingOffer::where('booked', false)->get();

        foreach($offers as $offer){
            $start = [
                'lng' => $offer->longitude_start,
                'lat' => $offer->latitude_start,
            ];
            $end = [
                'lng' => $offer->longitude_end,
                'lat' => $offer->latitude_end,
            ];

            $earthRadius = 6371000;
            $min_new_lat_start = $offer->latitude_start - (5000 / $earthRadius) * (180 / pi());
            $min_new_lng_start = $offer->longitude_start - (5000 / $earthRadius) * (180 / pi()) / cos($offer->latitude_start * pi() / 180);
            $plus_new_lat_start = $offer->latitude_start + (5000 / $earthRadius) * (180 / pi());
            $plus_new_lng_start = $offer->longitude_start + (5000 / $earthRadius) * (180 / pi()) / cos($offer->latitude_start * pi() / 180);
            $start_area = array($min_new_lat_start, $min_new_lng_start, $plus_new_lat_start, $plus_new_lng_start);

            $min_new_lat_end = $offer->latitude_end - (5000 / $earthRadius) * (180 / pi());
            $min_new_lng_end = $offer->longitude_end - (5000 / $earthRadius) * (180 / pi()) / cos($offer->latitude_end * pi() / 180);
            $plus_new_lat_end = $offer->latitude_end + (5000 / $earthRadius) * (180 / pi());
            $plus_new_lng_end = $offer->longitude_end + (5000 / $earthRadius) * (180 / pi()) / cos($offer->latitude_end * pi() / 180);

            $end_area = array($min_new_lat_end, $min_new_lng_end, $plus_new_lat_end, $plus_new_lng_end);

            $res = DB::select(
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
            foreach ($res as $r) {
                $results[] = $r->transport_offer_id;
            }


            $results = TransportOffer::whereIn('id', $results)->where('date_start', '<=', $offer->fixed_date)->where('date_start', '>=', date('Y-m-d H:i:s'))->where('full', 0)->get();
            if($results){
                $ids = [];
                foreach($results as $result){
                    $ids[] = $result->id;
                }
                if(count($ids) > 0){
                    $offer->user->notify(new Alerts($ids));
                    $offer->booked = true;
                    $offer->save();
                }
            }
        }
    }

}
