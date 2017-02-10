<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ShippingOffer;

class ShippingOffersController extends Controller{
    public function index(){
        $data = array();
        $shippings = ShippingOffer::all();
        $data['shippings'] = $shippings;
        
        return view('front.shipping.shippinglist', $data);
    }
}
