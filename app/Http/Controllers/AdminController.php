<?php

namespace App\Http\Controllers;

use App\User;
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
                    return back();
                }
                
                return view('admin.edit_user', [
                    'user' => $user,
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
