<?php

namespace App\Http\Controllers\Docencia;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Validator;

class cuentaController extends Controller
{

    public function __construct()
    {
        $this->middleware('docencia');
    }

    public function inicio()
    {
        if (auth()->guard('docencia')->user()->password == auth()->guard('docencia')->user()->original_password) {
            return \view('docencia.cuenta.index');
        } else {
            return redirect()->route('docencia.inicio');
        }
    }

    public function cambiarPassword(Request $request)
    {
        $reglas = [
            'password' => 'required|confirmed|min:8',
        ];

        $validator = Validator::make($request->all(), $reglas);

        $validacion = $validator->validate();

        if ($validator->fails()) {

            return route('docencia.cuenta.inicio')
                ->withErrors($validacion)
                ->withInput($request->all());

        } else {
            $user = auth()->guard('docencia')->user();
            $user->password = Hash::make($request->password);
            $user->save();
            Session::flash('passwordActualizada', 'Contraseña actualizada correctamente.');

            return redirect()->route('docencia.cuenta.inicio');
        }
    }

}
