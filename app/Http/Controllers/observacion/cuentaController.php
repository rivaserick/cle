<?php

namespace App\Http\Controllers\Observacion;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Categoria;
use App\Grupo;
use App\Observacion;
use App\Observacion_item;
use App\Profesor;
use App\Teacher_selfassessment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

class cuentaController extends Controller
{

    public function __construct()
    {
        $this->middleware('observacion');
    }

    public function inicio()
    {
        return \view('observacion.cuenta.index');
    }

    public function cambiarPassword(Request $request)
    {
        $reglas = [
            'password' => 'required|confirmed|min:8',
        ];

        $validator = Validator::make($request->all(), $reglas);

        $validacion = $validator->validate();

        if ($validator->fails()) {

            return route('observacion.cuenta.inicio')
                ->withErrors($validacion)
                ->withInput($request->all());

        } else {
            $user = auth()->guard('observacion')->user();
            $user->password = Hash::make($request->password);
            $user->save();
            Session::flash('passwordActualizada', 'Contraseña actualizada correctamente.');

            return redirect()->route('observacion.cuenta.inicio');
        }
    }
}
