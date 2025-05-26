<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthManager extends Controller
{
    function login(){
        return view("auth.login");
    }

    function loginPost(Request $request){
        $request->validate([
            "email"=> "required",
            "password"=> "required",
        ]);
        $cradentials = $request->only("email","password");
        if(Auth::attempt($cradentials)){
            return redirect()->intended(route("home"));
        }
        return redirect(route("login"))->with("error","Invalid Email or Password");
    }

    function logout(){
        Auth::logout();
        return redirect(route("login"));
    }
    function register(){
        return view("auth.register");
    }
    function registerPost(Request $request){
        $request->validate([ 
            "fullname" => "required",
            "email"=> "required|email",
            "password"=> "required|min:8",
         ]);
         $user = new User();
         $user->name = $request->fullname;
         $user->email = $request->email;
         $user->password = $request->password ;
         if($user->save()){
            return redirect(route("login"))->with("success","Registration Successfull");
         }
         return redirect(route("register"))->with("error","Register Failed");
    }
}

