<?php

namespace App\Http\Controllers\Docencia;

use App\Http\Controllers\Controller;
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

class observacionController extends Controller
{

    public function __construct()
    {
        $this->middleware('docencia');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function inicio()
    {
        $profesor = auth()->guard('docencia')->user();

        $grupos = $profesor->grupos;
        $observaciones = $grupos->pluck('observaciones')[0]->sortBy('fecha');
        //return $observaciones;
        return \view('docencia.observacion.index')
            ->with('observaciones', $observaciones);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @par4am  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function guardar(Request $request)
    {

        $id_profesor = auth()->guard('docencia')->user()->id;
        $reglas = array(
            'id' => 'required|integer',
            'id_teacher_self_assessment' => 'required|integer',
        );

        $validator = Validator::make($request->all(), $reglas);

        $validacion = $validator->validate();

        if ($validator->fails()) {
            return route('docencia.observacion.registrar')
                ->withErrors($validacion)
                ->withInput($request->all());

        } else {

            $observacion = Observacion::find(\request('id'));

            $observacion->observees_comment_text = \request('observees_comment');
            $observacion->id_teacher_self_assessment = \request('id_teacher_self_assessment');
            $observacion->fecha_feedback = Carbon::now();
            $observacion->save();

            return \redirect(route('docencia.observacion.inicio'));
        }
    }
    public function feedback(Request $request){
        $faces = Teacher_selfassessment::all();
        $observacion = Observacion::find(\request('id'));
        $categorias = Categoria::all();
        return \view('docencia.observacion.show')
            ->with([
                'observacion' => $observacion,
                'categorias' => $categorias,
                'faces' => $faces,
            ]);
    }

    public function grupos(Request $request){
        
        // TODO: DEFINIR LA VARIABLE A ENVIAR Y LA ESTRUCTURA DE LA VISTA

        return \view('docencia.observacion.index')
            ->with('grupos', $grupos);
    }

}
