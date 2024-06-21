<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    function index(){
        return view('login');
    }

    function postLogin(Request $request){

        //dd($request->all());

        $credentials = $request->only('email','password');

        // dd($credentials);

        if(Auth::attempt($credentials)){
            ('Login successful');
            $user = Auth::user();
            if ($user->role_id == 1) {
                return redirect()->intended('/admin');
            } else {
                return redirect()->intended('/home');
            }
        }
        else{
            //dd('Login fail');
            return redirect()->back()->withErrors(['fail' => 'Login failed. Please check your login information again'])->withInput($request->only('email'));
        }
    }

    public function logout(Request $request)
    {
        Auth::logout(); 
        $request->session()->invalidate(); // Hủy bỏ phiên làm việc hiện tại
        $request->session()->regenerateToken(); // Tạo lại CSRF token mới

        return redirect('/'); 
    }
}
