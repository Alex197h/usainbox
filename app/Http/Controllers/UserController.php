<?php

namespace App\Http\Controllers;

use App\TypeVehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;

class UserController extends Controller {
    public function getProfileAuth(){
        $auth = Auth::user();
        $data = array(
            'user' => $auth
        );

        return view('user.profile', $data);
    }

    public function getVehicles(){
        $auth = Auth::user();
        $type_vehicles = TypeVehicle::all();
        $data = array(
            'vehicles' => $auth->vehicles,
            'type_vehicles' => $type_vehicles
        );

        return view('user.vehicles', $data);
    }

    public function postVehicles(Request $request){
        $rules = array(
            'vehicle_type' => 'required|numeric',
            'vehicle_brand' => 'max:255',
            'vehicle_model' => 'max:255',
            'volume' => 'required|numeric',
            'length' => 'numeric',
            'width' => 'numeric',
            'height' => 'numeric',
            'default_vehicle' => 'boolean'

        );

        $this->validate($request, $rules);
        dd('coucou');
    }
}
