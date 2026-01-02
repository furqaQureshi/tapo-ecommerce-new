<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Logger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Show the admin login form
     * 
     * @return \Illuminate\View\View
     */
    public function showLoginForm()
    {
        return view('admin.auth.login');
    }

    /**
     * Handle an admin login request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            // if (!auth()->user()->hasRole('customer')) {
            //     $request->session()->regenerate();
            //     // return $credentials;
            //     Logger::log('login', 'admin', auth()->id(), 'Admin logged in successfully');

            //     return redirect()->intended('account/dashboard');
            // } else {
            //     dd(1);
            //     // return 'nh ho rha attempt auth';

            //     Log::info(['Non-admin tried to access admin login', 'User ID: ' . auth()->id()]);

            //     Logger::log('login_failed', 'admin', auth()->id(), 'Non-admin tried to access admin login', 'User ID: ' . auth()->id(), 'failed', 'warning');

            //     Auth::logout();
            //     return back()->withErrors([
            //         'email' => 'You do not have admin privileges.',
            //     ])->withInput($request->only('email'));
            // }

            if(auth()->user()->role_id == 1) //Admin Login
            {
                $request->session()->regenerate();

                Logger::log('login', 'admin', auth()->id(), 'Admin logged in successfully');

                return redirect()->intended('account/dashboard');
            }
            else if(auth()->user()->role_id == 4) //Customer Login
            {
                return redirect()->intended('my-account');
            }
        }
        else
        {
            Log::info(['Login attempt failed', 'Email: ' . $request->email]);
            Logger::log('login_failed', 'admin', null, 'Failed login attempt', 'Email: ' . $request->email, 'failed', 'warning');

            return back()->withErrors([
                'email' => 'The provided credentials do not match our records.',
            ])->withInput($request->only('email'));
        }
       
    }

    /**
     * Log the admin out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }
}
