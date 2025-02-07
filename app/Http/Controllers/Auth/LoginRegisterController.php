<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginRegisterController extends Controller
{
    /**
     * Instantiate a new LoginRegisterController instance.
     */
    public function __construct()
    {
        $this->middleware('guest')->except([
            'logout', 'dashboard'
        ]);
    }

    /**
     * Display a registration form.
     */
    public function register()
    {
        return view('auth.register');
    }

    /**
     * Store a new user.
     *
     */
    public function store(Request $request)
    {
        // $request->validate([
        //     'name_pelanggan' => 'required|string|max:250',
        //     'no_telefon_pelanggan' => 'required|email|max:13|unique:users',
        //     'email_pelanggan' => 'required|email|max:250|unique:users',
        //     'password_pelanggan' => 'required|min:8|confirmed'
        // ]);

        $user = User::create([
            'name' => $request->nama_pelanggan,
            'email' => $request->email_pelanggan,
            'password' => Hash::make($request->password_pelanggan)
        ]);

        // Log in the user
        Auth::login($user);

        // Regenerate session
        $request->session()->regenerate();

        // Redirect to home
        return redirect()->route('home')
            ->withSuccess('You have successfully registered & logged in!');
    }

    /**
     * Display a login form.
     */
    public function login()
    {
        return view('auth.login');
    }

     /**
     * Authenticate the user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if(Auth::attempt($credentials))
        {
            $request->session()->regenerate();
            return redirect()->route('home')
                ->withSuccess('You have successfully logged in!');
        }

        // Authentication failed, redirect back with an error message
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);

    } 
    
    // /**
    //  * Display a dashboard to authenticated users.
    //  *
    //  * @return \Illuminate\Http\Response
    //  */
    // public function dashboard()
    // {
    //     if(Auth::check())
    //     {
    //         return view('auth.dashboard');
    //     }
        
    //     return redirect()->route('login')->withErrors([
    //         'email' => 'Please login to access the dashboard.',
    //     ])->onlyInput('email');
    // } 

    
    
    /**
     * Log out the user from application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login')
            ->withSuccess('You have logged out successfully!');;
    } 
}
