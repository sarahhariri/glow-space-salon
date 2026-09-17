<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function registerPage(){
        return view('auth.register');
    }
    public function logout(){
        Auth::logout();
        return redirect('/');
    }
    public function register(Request $request){
        $fields = $request->validate([
            'email' => ['required', 'email', 'max:255'],
            'name' =>['required', 'string', 'max:255'],
            'password' => ['required', 'between:8,64', 'confirmed'],
            'terms' => ['accepted']
        ]);

        $user = User::create($fields);
        Auth::login($user);
        return redirect('/');
        
    }

    public function loginPage(){
        return view('auth.login');
    }
    public function login(Request $request){
        $fields = $request->validate([
            'email' => ['required'],
            'password' => ['required']
        ]);
        if(Auth::attempt($fields)){
            return redirect('/');
        }
        return redirect()->back()->with('error', 'wrong email or password');
    }
}
