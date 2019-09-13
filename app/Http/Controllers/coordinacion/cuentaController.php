<?php

namespace App\Http\Controllers\Coordinacion;

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
        $this->middleware('coordinacion');
    }

    public function inicio()
    {
        if (auth()->guard('coordinacion')->user()->password == auth()->guard('coordinacion')->user()->original_password) {
            return \view('coordinacion.cuenta.index');
        } else {
            return redirect()->route('coordinacion.inicio');
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

            return route('coordinacion.cuenta.inicio')
                ->withErrors($validacion)
                ->withInput($request->all());

        } else {
            $user = auth()->guard('coordinacion')->user();
            $user->password = Hash::make($request->password);
            $user->save();
            Session::flash('passwordActualizada', 'Contraseña actualizada correctamente.');

            return redirect()->route('coordinacion.cuenta.inicio');
        }
    }

}
