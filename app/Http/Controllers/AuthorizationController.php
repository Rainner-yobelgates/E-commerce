<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthorizationController extends Controller
{
    public function login()
    {
        return view('auth.login.login');
    }
    public function register(){
        return view('auth.register.register');
    }
    public function postregister(Request $request){
        $this->validate($request,[
        'username' => 'required',
            'email' => 'email|required',
            'password' => 'required|min:8|same:confirm-password',
            'confirm-password' => 'required|same:password'
        ]);
        $user = User::create([
            'name' => $request->username,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role_id' => 2
        ]);
        return redirect(route('login'))->with('success','Account has been create');
    }
    public function auth(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);
        if (Auth::attempt(request()->only('email', 'password'))) {
            $request->session()->regenerate();
            if (Auth()->User()->role_id == 1) {
                return redirect(route('dashboard'));
            } else if (Auth()->user()->role_id == 2) {
                return redirect(route('home'));
            }
        } else {
            return redirect(route('login'))->with('fail', 'Email or Password was wrong');
        }
    }
    public function dashboard()
    {
        return view('admin.dashboard.dashboard');
    }
    public function logout()
    {
        Auth::logout();
        return redirect(route('login'));
    }
}
