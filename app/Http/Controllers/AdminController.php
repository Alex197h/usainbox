<?php

namespace App\Http\Controllers;

use App\User;

class AdminController extends Controller {
    public function home(){
        // if(method_exists($this, $page)) return $this->$page($page, $part);
        // else return  view('errors.404');
        
        $users = User::all();
        
        return view('admin.home', [
            'users' => $users
        ]);
    }
}
