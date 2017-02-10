<?php

namespace App\Http\Controllers;

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
}
