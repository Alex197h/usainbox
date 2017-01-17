<?php

namespace App\Http\Controllers;

use Auth;
use Hash;
use App\User;
use App\DBMessages;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class UserController extends Controller {
	public function inscription(){
        $error = null;
        if(count($_POST)){
            if(isset($_POST['name'])&&$_POST['name']!='' && isset($_POST['password'])&&$_POST['password']!='' && isset($_POST['password2'])&&$_POST['password2']!=''
                && isset($_POST['email'])&&$_POST['email']!='' && isset($_POST['gender'])){
                extract($_POST);
                if(preg_match('/^[A-Za-z0-9-]{2,25}$/', $name)){
                    if(filter_var($email, FILTER_VALIDATE_EMAIL)){
                        if(strlen($password)>7){
                            if($password == $password2){
                                $exists = User::whereRaw("email = '$email' OR name = '$name'")->exists();
                                if(!$exists){
                                    $succes = true;
                                    User::create([
                                        'name' => $name,
                                        'email' => $email,
                                        'password' => bcrypt($password),
                                        'gender' => $gender,
                                    ]);
                                    return redirect()->intended('user/connexion')->with('inscription', [true]);
                                } else $error = 'Le pseudo ou l\'adresse mail est déjà pris.';
                            } else $error = 'Les deux mots de passe doivent être identiques.';
                        } else $error = 'Le mot de passe doit contenir au moins 8 caractères.';
                    } else $error = 'Le mail doit avoit un format correct.';
                } else $error = 'Le pseudo doit avoit un format correct.';
            } else $error = 'Vous devez remplir tous les champs.';
        }
        return view('inscription', ['error' => $error]);
    }
    
	public function connexion(){
        $error = null;
        if(count($_POST)){
            if(isset($_POST['login'])&&$_POST['login']!=''  && isset($_POST['password'])&&$_POST['password']!=''){
                extract($_POST);
                if(Auth::attempt(['login' => $login, 'password' => $password])){
                    return redirect()->intended('user/connexion')->with('connexion', [true]);
                }else $error = 'Le compte utilisateur n\'existe pas !';
            } else $error = 'Vous devez remplir tous les champs.';
        }
		return view('connexion', ['error' => $error]);
	}
    
	public function deconnexion(){
        Auth::logout();
        return redirect()->intended('user/connexion')->with('deconnexion', [true]);
    }
}
