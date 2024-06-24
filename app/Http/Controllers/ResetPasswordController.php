<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Support\Str;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class ResetPasswordController extends Controller
{
    public function index(){
        return view('forgot_pass');
    }

    public function sendMail(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors(['email' => 'User does not exist.']);
        }

        $newPassword = Str::random(10);
        $user->password = Hash::make($newPassword);
        $user->save();

        Mail::send('reset_password', ['newPassword' => $newPassword], function ($message) use ($user) {
            $message->to($user->email);
            $message->subject('Your New Password');
        });
        
        return redirect()->route('login')->with('status', 'We have e-mailed your new password!');
    }
}