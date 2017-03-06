<?php

namespace App\Http\Controllers;

use App\User;

class AdminController extends Controller {
    public function __construct(){
        $this->middleware('guest');
        $this->middleware('admin');
    }
    
    public function home(){
        $users = User::all();
        
        return view('admin.home', [
            'users' => $users
        ]);
    }
    
    public function page($page){
        if(method_exists($this, $page)) return $this->$page($page, $part);
        else return  view('errors.404');
        
    }
}
