<?php

namespace App\Http\Controllers;

use App\Reservation;
use App\TransportOffer;
use App\TypeVehicle;
use App\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use Auth;
use App\User;
use File;

class UserController extends Controller {
    public function getProfile(User $user){
        if(isset(Auth::user()->id) && $user->id == Auth::user()->id)
            return redirect()->route('user_profile');
        else
            return view('user.other_profile', ['user' => $user]);
    }

    public function getProfileAuth(){
        $auth = Auth::user();
        $reservations = Reservation::where('transporter_id', Auth::user()->id)
            ->where('validated', '0')
            ->count();


        $type_vehicles = TypeVehicle::all();
        $vehicles = $auth->vehicles;
        $vehicles_id = array();
        foreach ($vehicles as $vehicle){
            $vehicles_id[] = $vehicle->id;
        }
        $transport_offers = TransportOffer::whereIn('vehicle_id', $vehicles_id)->limit(5)->get();
        $city_steps = array();
        foreach ($transport_offers as $transport_offer){

            $steps = $transport_offer->steps;
            foreach ($steps as $step){
                $geocode=file_get_contents('http://maps.googleapis.com/maps/api/geocode/json?latlng='. $step['latitude'] .','. $step['longitude'] .'&sensor=false');

                $output= json_decode($geocode);

                if(isset($output->results[0])){

                    $city_steps[$transport_offer->id][$step->step] = $output->results[0]->address_components[2]->long_name;
                }
            }
        }
        $data = array(
            'user' => $auth,
            'type_vehicles' => $type_vehicles,
            'transport_offers' => $transport_offers,
            'steps' => $city_steps,
            'vehicles' => $vehicles,
            'reservations' =>$reservations
        );

        return view('user.profile', $data);
    }

    public function getBookingAuth(){
        $auth = Auth::user()->id;
        $reservations = Reservation::where('transporter_id', $auth)->get();

        $users = array();
        foreach($reservations as $reservation){
            $users[$reservation->id] = User::where('id', $reservation->shipper_id)->get();
//            dd($users[$reservation->id][0]->id);
        }



        return view('user.booking', array('reservations' => $reservations, 'users' => $users));
    }

    public function updateProfileAuth(Request $request){
        $auth = Auth::user();

        $rules = array(
            'gender' => 'required|boolean',
            'birthday' => 'required',
            'phone' => 'required|max:20',
            'avatar' => 'image',
        );
        if ($auth->email != $request->input('email'))
            $rules['email'] = 'required|email|max:255|unique:users';

        $this->validate($request, $rules);

        if ($auth->email != $request->input('email'))
            $auth->email = $request->input('email');
        $auth->gender = $request->input('gender');
        $auth->birthday = date('Y-m-d', strtotime($request->input('birthday')));
        $auth->phone = $request->input('phone');
        $auth->description = $request->input('description');
        if ($request->hasFile('avatar')) {
            if($request->avatar->isValid()){
                if($auth->avatar != 'default.jpg') $t = File::delete(public_path().'img/avatar/'.$auth->avatar);
                $myAvatar = $request->avatar->storeAs('img/avatar', 'avatar'.$auth->id.'.'.$request->avatar->extension(), 'public');
                $auth->avatar = 'avatar'.$auth->id.'.'.$request->avatar->extension();
            }
        }

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

        $vehicle->default = ($auth_vehicle_default == 0) ? 1 : $request->input('default_vehicle') ? 1 : 0;
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
            return redirect()->route('user_profile');
        }else{
            return redirect()->back()->withInput();
        }

    }


    public function deleteVehicle(Vehicle $vehicle){
        $vehicle->delete();
        return redirect()->route('user_profile')->with('message', 'Véhicule supprimé !');
    }

    public function modifyVehicles(Vehicle $vehicle, Request $request){
        if($request->isMethod('post')){

            $rules = array(
                'vehicle_type' => 'required|numeric',
                'vehicle_brand' => 'max:255',
                'vehicle_model' => 'max:255',
                'volume' => 'required|numeric',
                'length' => 'numeric',
                'width' => 'numeric',
                'height' => 'numeric',
                'weight' => 'numeric'

            );

            $this->validate($request, $rules);

            $vehicle->user_id = Auth::user()->id;

            $vehicle->type_vehicle_id = $request->input('vehicle_type');
            if($request->input('default_vehicle')){
                Vehicle::where('user_id', Auth::user()->id)->where('default', 1)->update(['default' => 0]);
            }

            if($request->has('default_vehicle')) $vehicle->default = $request->input('default_vehicle') ? 1 : 0;

            if ($request->has('width'))
                $vehicle->max_width = $request->input('width');
            else $vehicle->max_width = 0;

            if ($request->has('length'))
                $vehicle->max_length = $request->input('length');
            else $vehicle->max_length = 0;

            if ($request->has('height'))
                $vehicle->max_height = $request->input('height');
            else $vehicle->max_height = 0;

            if ($request->has('weight'))
                $vehicle->max_weight = $request->input('weight');
            else $vehicle->max_weight = 0;

            $vehicle->max_volume = $request->input('volume');
            $vehicle->car_brand = $request->input('vehicle_brand');
            $vehicle->car_model = $request->input('vehicle_model');

            if($vehicle->save()){
                return redirect()->route('user_profile')->with('message', 'Véhicule modifé !');
            }else{
                return redirect()->back()->withInput();
            }

        }else{

            $type_vehicles = TypeVehicle::all();
            return view('user.modify_vehicle', array('vehicle' => $vehicle, 'vehicle_types' => $type_vehicles));
        }
    }
}
