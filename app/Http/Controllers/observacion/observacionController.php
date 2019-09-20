<?php

namespace App\Http\Controllers\Observacion;

use App\Categoria;
use App\Grupo;
use App\Http\Controllers\Controller;
use App\Observacion;
use App\Observacion_item;
use App\Teacher_selfassessment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

class observacionController extends Controller
{

    public function __construct()
    {
        $this->middleware('observacion');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function inicio()
    {
        if (auth()->guard('observacion')->user()->password == auth()->guard('observacion')->user()->original_password) {
            return \view('observacion.cuenta.index');
        } else {
            $id_observador = auth()->guard('observacion')->user();
        $observaciones = $id_observador->observaciones;
            return \view('observacion.index')
                ->with('observaciones', $observaciones);
        }
    }

    public function grupos()
    {
        $grupos = Grupo::all();
        return \view('observacion.grupos')
            ->with('grupos', $grupos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function registrar()
    {
        $grupos = Grupo::all();
        $categorias = Categoria::all();
        return \view('observacion.create')
            ->with([
                'grupos' => $grupos,
                'categorias' => $categorias,
            ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function guardar(Request $request)
    {
        $id_observador = auth()->guard('observacion')->user()->id;
        $reglas = array(
            'codigo_del_grupo' => 'required',
            'strengths_observed' => 'required',
            'suggestions_improvement' => 'required',
            'general_observations' => 'required',
        );

        $validator = Validator::make($request->all(), $reglas);

        $validacion = $validator->validate();

        //return $validacion;

        if ($validator->fails()) {
            return route('observaciones.registrar')
                ->withErrors($validacion)
                ->withInput($request->all());

        } else {

            $id_grupo = str_replace('_', ' ', \request('codigo_del_grupo'));

            $observacion = Observacion::create([
                'id_grupo' => $id_grupo,
                'strengths_observed_text' => \request('strengths_observed'),
                'suggestions_improvement_text' => \request('suggestions_improvement'),
                'general_observations_text' => \request('general_observations'),
                'strengths_observed' => "",
                'suggestions_improvement' => "",
                'general_observations' => "",
                'id_observador' => $id_observador,
                'fecha' => Carbon::now(),

            ]);

            $scores = $request->all();
            unset($scores['codigo_del_grupo']);
            unset($scores['strengths_observed']);
            unset($scores['suggestions_improvement']);
            unset($scores['nombre_del_docente']);
            unset($scores['general_observations']);
            unset($scores['_token']);

            $scores_reales = array();
            foreach ($scores as $item => $valor) {
                $observacion_item = new Observacion_item;
                $observacion_item->id_observacion = $observacion->id;
                $observacion_item->id_item = $item;
                $observacion_item->score_item = $valor;
                $observacion_item->save();
            }

            return \redirect(route('observacion.inicio'));
        }
    }
    public function feedback(Request $request)
    {
        $faces = Teacher_selfassessment::all();
        $observacion = Observacion::find(\request('id'));
        $categorias = Categoria::all();
        return \view('observacion.show')
            ->with([
                'observacion' => $observacion,
                'categorias' => $categorias,
                'faces' => $faces,
            ]);
    }
}
