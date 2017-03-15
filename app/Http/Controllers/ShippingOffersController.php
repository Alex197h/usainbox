<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ShippingOffer;
use Auth;

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
            'date' => 'required'
        );

        $this->validate($request, $rules);

        $auth = Auth::user();

        $alert = new ShippingOffer();

        $infoPositionStart = str_replace(", ", '+',$request->input('city_start'));
        $geocodeStart=file_get_contents('http://maps.googleapis.com/maps/api/geocode/json?address='.$infoPositionStart.'&sensor=false');
        $outputStart= json_decode($geocodeStart);
        if(isset($outputStart->results[0])){
            $start_city = $outputStart->results[0]->geometry->location;
            $alert->longitude_start = $start_city->lng;
            $alert->latitude_start = $start_city->lat;
        }else{
            return redirect()->back()->withInput()->withErrors(['city_start' => 'L\'adresse n\'est pas valide']);
        }




        $infoPositionEnd = str_replace(", ", '+',$request->input('city_end'));
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

        if($alert->save()){
            return redirect()->route('user_profile')->with('message', 'Alerte enregistrée !');
        }else{
            return redirect()->back()->withInput();
        }


    }

}
