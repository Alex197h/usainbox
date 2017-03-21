<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TransportOffer;
use App\Vehicle;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $offers = TransportOffer::with('steps')->where('full', 0)->where('date_start', '>=', date('Y-m-d'))->get();

        $transport_offers = [];
        foreach($offers as $offer){
            if($offer->steps){
                foreach($offer->steps as $k => $step){
                    $transport_offers[$step->transport_offer_id][$k] = [
                        'lng' => $step->longitude,
                        'lat' => $step->latitude,
                        'label' => $step->label,
                    ];
                }
            }
        }
        return view('front.pages.accueil', ['transport_offers' => $transport_offers]);

    }

    public function ptest(){
        if(isset($_POST['transport'])){
            $result = [];
            $offers = TransportOffer::with('steps')->whereIn('id', $_POST['transport'])->get();

            foreach($offers as $offer){
                $user = $offer->user;
                $result[] = array_merge($offer->toArray(), [
                    'user' => array_merge($user->toArray(), [
                        'shipping_note' => $user->shipping_note,
                        'transport_note' => $user->transport_note
                    ])
                ], ['vehicle' => $offer->vehicle->typeVehicle->label]);
            }

            echo json_encode($result);
        }
    }
    
    public function getVehiclesBrands(Request $request){
        $id = $_REQUEST['id'];
        
        $vehicles = DB::select("SELECT car_brand, car_model FROM vehicles WHERE type_vehicle_id = $id");
        
        $brands = [];
        $models = [];
        foreach($vehicles as $vehicle){
            if(!in_array($vehicle->car_brand, $brands))
                $brands[] = $vehicle->car_brand;
            if(!in_array($vehicle->car_model, $models))
                $models[] = $vehicle->car_model;
        }
        
        return json_encode(['brands' => $brands, 'models' => $models]);
    }
}
