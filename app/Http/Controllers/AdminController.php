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
    
    public function page($page){
        if(method_exists($this, $page)) return $this->$page();
        else return abort(404);
        
    }
    
    public function users(){
        $users = User::all();
        return view('admin.users', [
            'users' => $users
        ]);
    }
}
