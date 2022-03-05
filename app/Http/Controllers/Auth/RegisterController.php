<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Hash;

class RegisterController extends Controller
{
    public function __construct(){
        $this->middleware('guest');
    }

    public function showRegisterForm(){
        return view('auth.register');
    }

    public function register(Request $request){
        $this->validate($request,[
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:5|confirmed'
        ]);
        $user = new User();
        if($this->doRegistration($request,$user) ){
            return redirect('/login')->with('registrationComplete','Successfully Registered');
        }
        return redirect('/register')->with('registrationFailed','Registration Failed');
    }

    protected function doRegistration(Request $request,User $user){
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $doneRegistration = $user->save();
        return $doneRegistration;
    }
}
