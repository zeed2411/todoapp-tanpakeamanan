<?php
// Http\controllers\authmanager.php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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

        $email = $request->email;
        $password = $request->password;

        $users = DB::select("SELECT * FROM users WHERE email = '$email' AND password = '$password'");

        if (count($users) > 0) {
            $user = User::find($users[0]->id);
            Auth::login($user);
            return redirect()->intended(route("home"));
        }
        return redirect(route("login"))->with("error", "Invalid Email or Password for: " . $email);
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
            "email"=> "required", // Hapus validasi email untuk testing
            "password"=> "required|min:8",
        ]);

        $user = new User();
        $user->name = $request->fullname;
        $user->email = $request->email;
        $user->password = $request->password; // Plaintext password

        if($user->save()){
            return redirect(route("login"))->with("success", "Registration Successful for: " . $request->fullname);
        }
        return redirect(route("register"))->with("error", "Register Failed for: " . $request->fullname);
    }


    function searchUser(Request $request){
        $keyword = $request->input('search');
        $users = DB::select("SELECT * FROM users WHERE name LIKE '%$keyword%'");

        return view("auth.search-results", compact('users', 'keyword'));
    }

    function updateProfile(Request $request){
        $user = Auth::user();
        $bio = $request->input('bio');
        DB::update("UPDATE users SET bio = '$bio' WHERE id = {$user->id}");

        return redirect()->back()->with("success", "Profile updated successfully for: " . $bio);
    }

}
