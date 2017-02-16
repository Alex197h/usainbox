<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function create()
    {
        return view('front.pages.contact');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:100',
            'email' => 'required|email|max:100',
            'message' => 'required',
        ]);

        return redirect('contact')->with('status', 'Message envoyé !');
    }
    
    
    
    public function test(){
        
        
        return view('front.pages.test');
    }
}
