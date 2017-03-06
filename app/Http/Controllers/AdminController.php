<?php

namespace App\Http\Controllers;

use App\User;

class AdminController extends Controller {
    public function __construct(){
        $this->middleware('admin');
    }
    
    public function home(){
        return view('admin.home');
    }
    
    public function page($page, $type = '', $id = null){
        if(method_exists($this, $page)) return $this->$page($type, $id);
        else return $this->home();
        
    }
    
    public function users($page, $id){
        if($page == 'edit'){
            $user = User::find($id);
            if($user){
                return view('admin.edit_user', [
                    'user' => $user
                ]);
            }
        }
        
        $users = User::all();
        return view('admin.users', [
            'users' => $users
        ]);
    }
}
