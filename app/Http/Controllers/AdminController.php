<?php

namespace App\Http\Controllers;

use App\User;
use App\Vehicle;
use App\TypeVehicle;
use Illuminate\Http\Request;

class AdminController extends Controller {
    public function __construct(){
        $this->middleware('admin');
    }
    
    public function home(){
        return view('admin.home');
    }
    
    public function page($page, $type = '', $id = null, Request $request = null){
        $this->post = $request && $request->isMethod('post');
        if(method_exists($this, $page)) return $this->$page($type, $id, $request);
        else return $this->home();
        
    }
    
    public function users($page, $id, $request){
        if($page == 'edit'){
            $user = User::find($id);
            if($user){
                if($this->post && $request->has('save_user')){
                    $user->last_name = $request->get('last_name');
                    $user->first_name = $request->get('first_name');
                    $user->email = $request->get('email');
                    $user->phone = $request->get('phone');
                    $user->gender = $request->get('gender');
                    $user->birthday = $request->get('birthday');
                    $user->description = $request->get('description');
                    $user->help_charge = $request->get('help_charge') == 1 ? 1 : 0;
                    $user->is_admin = $request->get('is_admin') == 1 ? 1 : 0;
                    
                    if($request->has('password')){
                        $user->password = bcryp($request->get('password'));
                    }
                    
                    if($user->isDirty()){
                        $user->save();
                    }
                    return back()->with('part', 'profil');
                }
                else if($this->post && $request->has('rem_vehicle')){
                    $vehicle = Vehicle::find($request->input('rem_vehicle'));
                    $vehicle->delete();
                    return back()->with('part', 'vehicle');
                }
                else if($this->post && $request->has('save_vehicle')){
                    $vehicle = Vehicle::find($request->input('save_vehicle'));
                    
                    if(!$vehicle){
                        $vehicle = new Vehicle();
                        $vehicle->user_id = $user->id;
                    }
                    
                    $vehicle->car_brand = $request->input('car_brand');
                    $vehicle->car_model = $request->input('car_model');
                    $vehicle->type_vehicle_id = $request->input('type_vehicle_id');
                    
                    $vehicle->max_volume = $request->input('max_volume') ?: 0;
                    $vehicle->max_weight = $request->input('max_weight') ?: 0;
                    $vehicle->max_width = $request->input('max_width') ?: 0;
                    $vehicle->max_length = $request->input('max_length') ?: 0;
                    $vehicle->max_height = $request->input('max_height') ?: 0;
                    
                    if($request->has('default')) $vehicle->setDefault();
                    
                    if($vehicle->isDirty()){
                        $vehicle->save();
                    }
                    return back()->with('part', 'vehicle');
                }
                
                
                $v = new Vehicle();
                $user->vehicles->push($v);
                
                return view('admin.edit_user', [
                    'part' => session()->has('part') ? session('part') : $request->has('save_vehicle') ? 'vehicle' : 'profil',
                    'user' => $user,
                    'vehicles' => $user->vehicles,
                    'type_vehicles' => TypeVehicle::all()
                ]);
            }
        }
        
        $users = User::all();
        return view('admin.users', [
            'users' => $users
        ]);
    }
}
