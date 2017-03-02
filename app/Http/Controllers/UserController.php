<?php

namespace App\Http\Controllers;

use App\TypeVehicle;
use App\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use App\User;

class UserController extends Controller {

    public function getProfile(User $user){
        if($user->id == Auth::user()->id)
            return redirect()->route('user_profile');
        else
            return view('user.other_profile', ['user' => $user]);
    }

    public function getProfileAuth(){
        $auth = Auth::user();
        $data = array(
            'user' => $auth
        );

        return view('user.profile', $data);
    }

    public function updateProfileAuth(Request $request){
        $auth = Auth::user();

        $rules = array(
            'gender' => 'required|boolean',
            'birthday' => 'required|date',
            'phone' => 'required|max:20',
        );
        if ($auth->email != $request->input('email'))
            $rules['email'] = 'required|email|max:255|unique:users';

        $this->validate($request, $rules);

        if ($auth->email != $request->input('email'))
            $auth->email = $request->input('email');
        $auth->gender = $request->input('gender');
        $auth->birthday = $request->input('birthday');
        $auth->phone = $request->input('phone');
        $auth->description = $request->input('description');

        if($auth->save())
            return redirect()->route('user_profile');
        else
            return redirect()->back()->withInput();
    }



    public function getVehicles(){
        $auth = Auth::user();
        $type_vehicles = TypeVehicle::all();
        $vehicles = $auth->vehicles;
        $data = array(
            'type_vehicles' => $type_vehicles,
            'vehicles' => $vehicles
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
            'height' => 'numeric'

        );

        $this->validate($request, $rules);

        $auth_vehicle_default = Vehicle::where('user_id', Auth::user()->id)->where('default', 1)->count();

        $vehicle = new Vehicle();
        $vehicle->type_vehicle_id = $request->input('vehicle_type');
        $vehicle->user_id = Auth::user()->id;
        if($auth_vehicle_default == 1 && $request->input('default_vehicle')){
            Vehicle::where('user_id', Auth::user()->id)->where('default', 1)->update(['default' => 0]);
        }
        $vehicle->default = $request->input('default_vehicle') ? 1 : 0;
        if ($request->has('width')) $vehicle->max_width = $request->input('width');
        if ($request->has('length'))
        $vehicle->max_length = $request->input('length');
        if ($request->has('height'))
        $vehicle->max_height = $request->input('height');
        $vehicle->max_volume = $request->input('volume');
        if ($request->has('weight')) $vehicle->max_weight = $request->input('weight');
        $vehicle->car_brand = $request->input('vehicle_brand');
        $vehicle->car_model = $request->input('vehicle_model');

        if($vehicle->save()){
            return redirect()->route('user_vehicles', [Auth::user()->id]);
        }else{
            return redirect()->back()->withInput();
        }

    }
}
