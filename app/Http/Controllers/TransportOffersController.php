<?php

namespace App\Http\Controllers;

use App\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\TransportOffer;
use App\TransportStep;
use App\Vehicle;
use App\Question;
use App\TypeVehicle;
use Auth;
use Debugbar;

class TransportOffersController extends Controller
{
    public function index()
    {
        return redirect()->route('home');
    }

    public function create()
    {
        $auth = Auth::user();
        $vehicles = $auth->vehicles;
        if ($vehicles && $vehicles->isEmpty()) {
            return redirect()->route('user_vehicles');
        }
        $data = array(
            'vehicles' => $vehicles
        );
        return view('front.transport.create', $data);
    }

    public function postCreate(Request $request)
    {
        $rules = array(
            'start_city' => 'required|max:255',
            'end_city' => 'required|max:255',
            'vehicle' => 'required|numeric',
            'date_start' => 'required',
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
        $datetime = $request->input('date_start').' '.$request->input('hour_start');

        $transport->date_start = $datetime;

        $transport->is_regular = $request->input('is_regular') ? 1 : 0;
        $transport->highway = $request->input('highway') ? 1 : 0;
        $transport->detour = $request->input('start_detour') ? 1 : 0;
        if ($request->has('description')) $transport->description = $request->input('description');
        $transport->vehicle_id = $request->input('vehicle');
        if ($transport->save()) {
            $step1 = new TransportStep();
            $step1->transport_offer_id = $transport->id;
            $step1->label = $request->input('start_city');
            $infoPosition = str_replace(' ', '+', $request->input('start_city'));
            $geocode = file_get_contents('http://maps.googleapis.com/maps/api/geocode/json?address=' . $infoPosition . '&sensor=false');
            $output = json_decode($geocode);
            $step1->latitude = $output->results[0]->geometry->location->lat;
            $step1->longitude = $output->results[0]->geometry->location->lng;
            $step1->step = 1;
            $tabSteps = array();
            for ($i = 0; $i < sizeof($request->steps); $i++) {
                $step = new TransportStep();
                $step->transport_offer_id = $transport->id;
                $step->label = $request->steps[$i];
                $infoPositionStep = str_replace(' ', '+', $request->steps[$i]);
                $geocodeStep = file_get_contents('http://maps.googleapis.com/maps/api/geocode/json?address=' . $infoPositionStep . '&sensor=false');
                $outputStep = json_decode($geocodeStep);
                $step->latitude = $outputStep->results[0]->geometry->location->lat;
                $step->longitude = $outputStep->results[0]->geometry->location->lng;
                $step->step = $i + 2;
                $tabSteps[] = $step;
            }
            $steplast = new TransportStep();
            $steplast->transport_offer_id = $transport->id;
            $steplast->label = $request->input('end_city');
            $infoPositionEnd = str_replace(' ', '+', $request->input('end_city'));
            $geocodeEnd = file_get_contents('http://maps.googleapis.com/maps/api/geocode/json?address=' . $infoPositionEnd . '&sensor=false');
            $outputEnd = json_decode($geocodeEnd);
            $steplast->latitude = $outputEnd->results[0]->geometry->location->lat;
            $steplast->longitude = $outputEnd->results[0]->geometry->location->lng;
            $steplast->step = sizeof($request->steps) + 2;
            $step1->save();
            foreach ($tabSteps as $onestep) {
                $onestep->save();
            }
            $steplast->save();
            return redirect()->route('detail_transport_offer', $transport->id);
        } else return redirect()->back()->withInput();


    }


    public function search(Request $request)
    {
        if ($request->input('city_start') != "") {
            $infoPositionStart = str_replace(" ", '+', $request->input('city_start'));
            $geocodeStart = file_get_contents('http://maps.googleapis.com/maps/api/geocode/json?address=' . $infoPositionStart . '&sensor=false');
            $outputStart = json_decode($geocodeStart);
            if (isset($outputStart->results[0])) {
                $start_city = $outputStart->results[0]->geometry->location;
            } else {
                return redirect()->back()->withInput()->with('message_error', 'La ville de départ n\'est pas valide');
            }
        } else {
            $start_city = "";
        }

        if ($request->input('city_end') != "") {
            $infoPositionEnd = str_replace(" ", '+', $request->input('city_end'));
            $geocodeEnd = file_get_contents('http://maps.googleapis.com/maps/api/geocode/json?address=' . $infoPositionEnd . '&sensor=false');
            $outputEnd = json_decode($geocodeEnd);
            if (isset($outputEnd->results[0])) {
                $end_city = $outputEnd->results[0]->geometry->location;
            } else {
                return redirect()->back()->withInput()->with('message_error', 'La ville d\'arrivée n\'est pas valide');
            }
        } else {
            $end_city = "";
        }

        $earthRadius = 6371000;
        $min_new_lat_start = $start_city->lat - (5000 / $earthRadius) * (180 / pi());
        $min_new_lng_start = $start_city->lng - (5000 / $earthRadius) * (180 / pi()) / cos($start_city->lat * pi() / 180);
        $plus_new_lat_start = $start_city->lat + (5000 / $earthRadius) * (180 / pi());
        $plus_new_lng_start = $start_city->lng + (5000 / $earthRadius) * (180 / pi()) / cos($start_city->lat * pi() / 180);
        $start_area = array($min_new_lat_start, $min_new_lng_start, $plus_new_lat_start, $plus_new_lng_start);

        $min_new_lat_end = $end_city->lat - (5000 / $earthRadius) * (180 / pi());
        $min_new_lng_end = $end_city->lng - (5000 / $earthRadius) * (180 / pi()) / cos($end_city->lat * pi() / 180);
        $plus_new_lat_end = $end_city->lat + (5000 / $earthRadius) * (180 / pi());
        $plus_new_lng_end = $end_city->lng + (5000 / $earthRadius) * (180 / pi()) / cos($end_city->lat * pi() / 180);
        $end_area = array($min_new_lat_end, $min_new_lng_end, $plus_new_lat_end, $plus_new_lng_end);


        $offers = DB::select(
            "SELECT transport_offer_id
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
            )",
            [
                // 'label' => $request->input('city_start'),
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
        foreach ($offers as $offer) {
            $results[] = $offer->transport_offer_id;
        }

        $view_offers = TransportOffer::with('steps')->whereIn('id', $results)->where('date_start', '>=', $request->input('date'))->where('full', 0)->orderBy('date_start')->get();

        $city_steps = array();
        foreach ($view_offers as $view_offer) {
            $steps = $view_offer->steps;
            foreach ($steps as $step) {
                // var_dump($step->toArray());
                // $geocode = file_get_contents('http://maps.googleapis.com/maps/api/geocode/json?latlng=' . $step['latitude'] . ',' . $step['longitude'] . '&sensor=false');

                // $output = json_decode($geocode);

                // $res = '';
                // if (isset($output->results[0])) {
                    // foreach($output->results[0]->address_components as $e){
                        // if(in_array('locality', $e->types)){
                            // $res = $e->long_name;
                            // break;
                        // }
                    // }
                    $city_steps[$view_offer->id][$step->step] = $step->label;
                // }
            }
        }


        return view('front.transport.list', [
            'offers' => $view_offers,
            'steps' => $city_steps,
            'city_start' => $request->input('city_start'),
            'city_end' => $request->input('city_end')
        ]);
    }

    public function detail(Request $request, TransportOffer $transportOffer){
        $city_steps = array();

        $steps = $transportOffer->steps;
        $user = $transportOffer->user;
        $auth = Auth::user();

        foreach ($steps as $step) {
            // $geocode = file_get_contents('http://maps.googleapis.com/maps/api/geocode/json?latlng=' . $step['latitude'] . ',' . $step['longitude'] . '&sensor=false');

            // $output = json_decode($geocode);

            // if (isset($output->results[0])) {
                // $res = '';
                // foreach($output->results[0]->address_components as $e){
                    // if(in_array('locality', $e->types)){
                        // $res = $e->long_name;
                        // break;
                    // }
                // }

                $city_steps[$transportOffer->id][$step->step] = $step->label;
            // }
        }

        if($request->has('question')){
            $question = new Question();

            $question->user_id = $auth->id;
            $question->transport_offer_id = $transportOffer->id;
            $question->question = $request->question;
            // dd($question->toArray());
            $question->save();
            return redirect()->back();
        }

        $vehicle = $transportOffer->vehicle;


        return view('front.transport.detail', [
            'offer' => $transportOffer,
            'reviews' => Reservation::where('transporter_id', $user->id)->whereNotNull('shipping_review')->select('shipping_review as review', 'shipping_note as note')->inRandomOrder()->limit(5)->get(),
            'questions' => $transportOffer->questions,
            'user' => $user,
            'auth' => $auth,
            'vehicle' => $vehicle,
            'steps' => $city_steps
        ]);
    }


    public function booking(Request $request){
        $rules = array(
            'transporter_id' => 'required|numeric',
            'transport_offer_id' => 'required|numeric'
        );

        $this->validate($request, $rules);

        $transport_offer = TransportOffer::where('id', $request->input('transport_offer_id'))->first();
        $steps = $transport_offer->steps;

        $city_steps = array();

        foreach ($steps as $step) {
            // $geocode = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?latlng=' . $step['latitude'] . ',' . $step['longitude'] . '&sensor=false');

            // $output = json_decode($geocode);

            // if (isset($output->results[0])) {
                // $res = '';
                // foreach($output->results[0]->address_components as $e){
                    // if(in_array('locality', $e->types)){
                        // $res = $e->long_name;
                        // break;
                    // }
                // }
                $city_steps[$step->step] = $step->label;

            // }
        }
//        var_dump($city_steps);
        return view('front.transport.form_booking', array('city_steps' => $city_steps, 'transporter_id' => $request->input('transporter_id'), 'transport_offer' => $transport_offer));

    }

    public function booking_validate(Request $request){
        $rules = array(
            'transporter_id' => 'required|numeric',
            'transport_offer_id' => 'required|numeric',
            'step_start' => 'required|numeric',
            'step_end' => 'required|numeric',
            'parcel_volume' => 'required|numeric'
        );

        $this->validate($request, $rules);

        $transport_offer = TransportOffer::where('id', $request->input('transport_offer_id'))->first();

        $booking = new Reservation();

        $booking->passage_date = date('Y-m-d', strtotime($transport_offer->date_start));
        $booking->hour = null;
        $booking->transport_offer_id = $request->input('transport_offer_id');
        $booking->parcel_volume = $request->input('parcel_volume');
        $booking->shipper_id = Auth::user()->id;
        $booking->transporter_id = $request->input('transporter_id');

        $transport_step_start = TransportStep::where('transport_offer_id', $request->input('transport_offer_id'))->where('step', $request->input('step_start'))->first();
        $booking->city_start_longitude = $transport_step_start->longitude;
        $booking->city_start_latitude = $transport_step_start->latitude;
        $booking->city_start_label = $transport_step_start->label;

        $transport_step_end = TransportStep::where('transport_offer_id', $request->input('transport_offer_id'))->where('step', $request->input('step_end'))->first();
        $booking->city_end_longitude = $transport_step_end->longitude;
        $booking->city_end_latitude = $transport_step_end->latitude;
        $booking->city_end_label = $transport_step_end->label;

        if($booking->save())
            return redirect()->route('user_profile')->with('message', 'Réservation envoyée');
        else
            return redirect()->back()->withInput();


    }
}
