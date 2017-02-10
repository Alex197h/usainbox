<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\TransportOffer;
use App\Vehicle;

class TransportOffersController extends Controller {
    public function index(){
        // var_dump(Vehicle::where('id', '1'));
        
        /**
            Si !date_start passée ou !full
        */
        
        $offers = TransportOffer::all();
        
        return view('front.transport.list', ['offers' => $offers]);
    }
}
