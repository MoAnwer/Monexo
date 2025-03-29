<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use App\Mail\WelcomeMail;

class AuthController extends Controller
{
    protected $channel;

    public function __construct() 
    {
        $this->channel = Log::build(['driver' => 'single', 'path' => storage_path('logs/errors.log')]);
    }

    public function loginPage() 
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
            return to_route('dashboard');
        }

        return back()->withErrors([
            'email' => trans('auth.failed')
        ]);
    }

    public function forgetPassword () 
    {
        return view('auth.forget-password');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return to_route('login');
    }

    public function registerPage()
    {
        return view('auth.register');
    }

    public function register(Request $request) 
    {
        try {

            $credentials = $request->validate([
                'name'  => 'string|required',
                'email' => 'required|email',
                'password' => 'required|min:6'
            ]);

            $credentials['password'] = bcrypt($request->password);

            $user = User::create($credentials);

            Auth::login($user);
                \Mail::to($request->email)->send(new WelcomeMail);
                return to_route('dashboard');                

        } catch (\PODException $e) {

            Log::stack(['stack' => $this->channel])->warning(['Failed to register : ', $e->getMessage(), ['register_data' => $request->all()]]);
            return to_route('registerPage')->withErrors([
                'email'  => 'This email already exist, use anothr email.'
            ]); 
            
        } catch (\Exception $e) {

            Log::stack(['stack' => $this->channel])->warning(['Failed to register : ', $e->getMessage(), ['register_data' => $request->all()]]);
            return to_route('registerPage')->withErrors([
                'password'  => 'The password must be at least 6 characters.'
            ]);
        }

    }
}
