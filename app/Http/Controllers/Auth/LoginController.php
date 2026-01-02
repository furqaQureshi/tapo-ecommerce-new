<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }
    protected function authenticated(Request $request, $user)
    {
        if ($user->is_suspended == 1) {
            Auth::logout();

            return redirect()->back()->with([
                'error' => 'Your account has been suspended.',
            ]);
        }

        if ($user->subscription_status == 0) {
            return redirect()->route('subscriber-form')->with([
                'success' => 'Let’s get you started',
            ]);
        } else {
            if (auth()->user()->completed_profile == 0) {
                // return redirect()->route('onboarding.show');
                return redirect()->route('myaccount')->with([
                    'profile_incomplete' => [
                        'message' => 'Hey ' . auth()->user()->name . ' Want to receive more relevant products next month? Be sure to complete your profile',
                        'button_text' => 'Complete My Profile',
                        'button_url' => route('onboarding.show'),
                    ],
                ]);
            } else {
                return redirect()->route('myaccount');
            }
        }
    }
}
