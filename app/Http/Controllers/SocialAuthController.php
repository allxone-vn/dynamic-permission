<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Exception;
use Illuminate\Support\Facades\Hash;

class SocialAuthController extends Controller
{
    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function handleFacebookCallback()
    {
        try {
        
            $user = Socialite::driver('facebook')->user();
         
            $finduser = User::where('facebook_id', $user->id)->first();
         
            if($finduser){
         
                Auth::login($finduser);
       
                return redirect()->intended('/home');
         
            }else{
                $newUser = User::updateOrCreate(['email' => $user->email],[
                        'username' => $user->name,
                        'facebook_id'=> $user->id,
                        'password' => Hash::make('123'),
                        'role_id' => 4
                    ]);
        
                Auth::login($newUser);
        
                return redirect()->intended('/home');
            }
       
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}
