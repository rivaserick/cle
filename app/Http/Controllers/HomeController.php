<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Validator;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (!Auth::user()->password_changed) {
            return view('auth.passwords.reset')
                ->with('token', Str::random(60));
        } else {
            return view('home');
        }
    }

    public function resetPassword(Request $request)
    {
        $reglas = [
            'token' => 'required',
            'password' => 'required|confirmed|min:8',
        ];

        $validator = Validator::make($request->all(), $reglas);

        $validacion = $validator->validate();

        if ($validator->fails()) {

            return route('home')
                ->withErrors($validacion)
                ->withInput($request->all());

        } else {
            $user = Auth::user();
            $user->password = Hash::make($request->password);
            $user->password_changed = true;
            $user->save();
            Session::flash('passwordActualizada', 'Contraseña actualizada correctamente.');

            return redirect()->route('home');
        }
    }

}
