<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class CoordinacionLoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Observador Login Controller
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
    protected $redirectTo = '/coordinacion/inicio';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function username()
    {
        return 'username';
    }

    public function guard()
    {
        return auth()->guard('coordinacion');
    }

    // login from for coordinador
    public function showLoginForm()
    {
        return view('auth.coordinacion.login');
    }
}
