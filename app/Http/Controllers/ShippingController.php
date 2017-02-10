<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ShippingOffer;

class ShippingController extends Controller
{
  public function getHome(){

  $data = array();

  $shippings = ShippingOffer::all();

  $data['shippings'] = $shippings;

  return view('front.shipping.shippinglist', $data);
  }
}
