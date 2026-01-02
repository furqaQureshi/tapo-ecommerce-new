<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class SocialController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')
            ->redirectUrl(env('GOOGLE_CLIENT_REDIRECT'))
            ->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')
                ->redirectUrl(env('GOOGLE_CLIENT_REDIRECT'))
                ->user();

            $user = User::where('email', $googleUser->email)->first();

            if ($user) {
                Auth::login($user);
            } else {
                $user = User::create([
                    'name' => $googleUser->name,
                    'email' => $googleUser->email,
                    'password' => bcrypt('123456dummy'),
                ]);

                Auth::login($user);
            }

            return redirect()->route('front.home');

        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }
    // public function redirectToFacebook()
    // {
    //     return Socialite::driver('facebook')->redirect();
    // }

    // public function handleFacebookCallback()
    // {
    //     $user = Socialite::driver('facebook')->user();

    //     $findUser = User::where('email', $user->email)->first();

    //     if ($findUser) {
    //         Auth::login($findUser);
    //     } else {
    //         $newUser = User::create([
    //             'name' => $user->name,
    //             'email' => $user->email,
    //             'password' => bcrypt('123456dummy'),
    //         ]);

    //         Auth::login($newUser);
    //     }

    //     return redirect('/dashboard');
    // }
}
