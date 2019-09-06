<?php

namespace App\Http\Controllers\coordinacion;

use App\Http\Controllers\Controller;
use App\Period;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Validator;

class ajustesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:coordinacion');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function inicio()
    {
        $periodos = Period::orderBy('id')->get();
        return \view('coordinacion.ajustes.index')
            ->with(
                'periodos', $periodos
            );
    }

    public function agregarPeriodo(Request $request)
    {
        $reglas = array(
            'nombre' => 'required|unique:periods',
            'descripcion' => 'required|unique:periods',
            'fecha_de_inicio' => 'required|date',
            'fecha_de_fin' => 'required|date',
        );

        $validator = Validator::make($request->all(), $reglas);

        $validacion = $validator->validate();

        if ($validator->fails()) {

            return route('coordinacion.ajustes.inicio')
                ->withErrors($validacion)
                ->withInput($request->all());

        } else {
            Period::create([
                'nombre' => \request('nombre'),
                'descripcion' => \request('descripcion'),
                'fecha_inicio' => \request('fecha_de_inicio'),
                'fecha_fin' => \request('fecha_de_fin'),
                'vigente' => false,
            ]);

            Session::flash('message', 'Período registrado correctamente.');

            return redirect()->route('coordinacion.ajustes.inicio');
        }
    }

    public function periodoVigente(Request $request)
    {

        $reglas = array(
            'periodo_vigente' => [
                'required', 'integer',
                Rule::in(Period::all()->pluck('id')),
            ],
        );

        $validator = Validator::make($request->all(), $reglas);

        $validacion = $validator->validate();

        if ($validator->fails()) {

            return route('coordinacion.ajustes.inicio')
                ->withErrors($validacion)
                ->withInput($request->all());

        } else {
            Period::where('id', '!=', \request('periodo_vigente'))
                ->update(['vigente' => false]);
            Period::where('id', \request('periodo_vigente'))
                ->update(['vigente' => true]);

            Session::flash('message', 'El período se estableció correctamente como vigente.');

            return redirect()->route('coordinacion.ajustes.inicio');
        }
    }

    public function altaDocentesActivos(Request $request)
    {
        //$path = $request->file('archivo_docentes')->store('public/archivo_docente/');
        return 'En construccion...';
    }
}
