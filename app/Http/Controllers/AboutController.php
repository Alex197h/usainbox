<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TransportOffer;

class AboutController extends Controller{
    public function about(){
        return view('front.pages.about');
    }
    
    public function create(){
        return view('front.pages.contact');
    }

    public function store(Request $request){
        $this->validate($request, [
            'name' => 'required|max:100',
            'email' => 'required|email|max:100',
            'message' => 'required',
        ]);

        return redirect('contact')->with('status', 'Message envoyé !');
    }
    
    
    
    public function test(){
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
        
        return view('front.pages.test', ['transport_offers' => $transport_offers]);
    }
}
