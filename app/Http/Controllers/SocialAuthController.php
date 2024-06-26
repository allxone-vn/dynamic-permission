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

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $user = Socialite::driver('google')->stateless()->user();
            $finduser = User::where('google_id', $user->id)->first();

            if ($finduser) {
                Auth::login($finduser);
                return redirect()->route('home');
            } else {
                $newuser = User::create([
                    'username' => $user->name,
                    'google_id'=> $user->id,
                    'password' => Hash::make('123'),
                    'role_id' => 4 // or you can leave this blank
                ]);

                Auth::login($newuser);
                return redirect()->route('home');
            }

        } catch (Exception $e) {
            return redirect()->route('login')->withErrors(['error' => 'Failed to login with Google.']);
        }
    }
}
