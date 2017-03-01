<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TransportOffer;

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
        $offers = TransportOffer::all();

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
        $offer = TransportOffer::whereIn('id', $_POST['transport'])->get();
        echo json_encode($offer->toArray());
    }
}
