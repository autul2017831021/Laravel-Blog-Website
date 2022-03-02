<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function __construct(){
        //$this->middleware('user')->except('login');
    }

    public function showLoginForm(){
        return view('auth.login');
    }

    public function login(Request $request){
        $credentials = $this->getCredentials($request);

        if($this->attemptLogin($request,$credentials)){
            return $this->sendLoginResponse($request);
        }

        return $this->sendFailedLoginResponse($request);
    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();

        return redirect('/');
    }

    /// protected functions
    protected function getCredentials(Request $request){
        return $credentials = [
            'email' => $request->email,
            'password' => $request->password
        ];
    }

    protected function attemptLogin(Request $request, Array $credentials){
        return Auth::attempt($credentials, $request->has('remember'));
    }

    protected function sendLoginResponse(Request $request){
        $request->session()->regenerate();
        return redirect('/');
    }

    protected function sendFailedLoginResponse(){
        return redirect()->back()->withErrors([
            'email' => 'Please use correct Email & Password',
            'password' => 'Please use correct Email & Password'
        ]);
    }
}
