<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TransportOffer;
use Illuminate\Support\Facades\View;

class AboutController extends Controller{
    public function page($page){
        return (View::exists("front.static.$page")) ? view("front.static.$page") : abort(404);
    }
    
    public function contact(){
        return view('front.pages.contact');
    }

    public function postcontact(Request $request){
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
    
    public function ptest(){
        $offer = TransportOffer::whereIn('id', $_POST['transport'])->get();
        echo json_encode($offer->toArray());
    }
}
