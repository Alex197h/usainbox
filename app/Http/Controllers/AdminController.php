<?php

namespace App\Http\Controllers;

use App\User;

class AdminController extends Controller {
    public function home(){
        $users = User::all();
        
        return view('admin.home', [
            'users' => $users
        ]);
    }
}
