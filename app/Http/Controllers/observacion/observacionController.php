<?php

namespace App\Http\Controllers\Observacion;

use App\Categoria;
use App\Grupo;
use App\Http\Controllers\Controller;
use App\Observacion;
use App\Observacion_item;
use App\Profesor;
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
        $observaciones = Observacion::all();
        return \view('observacion.index')
            ->with('observaciones', $observaciones);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function registrar()
    {
        $grupos = Grupo::where('id', '!=', 'vjfkd')->get();
        $profesores = Profesor::all();
        $categorias = Categoria::all();
        return \view('observacion.create')
            ->with([
                'grupos' => $grupos,
                'categorias' => $categorias,
                'profesores' => $profesores,
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

            $observacion = Observacion::create([
                'id_grupo' => \request('codigo_del_grupo'),
                'strengths_observed' => \request('strengths_observed'),
                'suggestions_improvement' => \request('suggestions_improvement'),
                'general_observations' => \request('general_observations'),
                'id_observador' => auth()->guard('observacion')->user()->id,
                'fecha' => Carbon::now(),

            ]);

            $scores = $request->all();
            unset($scores['codigo_del_grupo']);
            unset($scores['strengths_observed']);
            unset($scores['suggestions_improvement']);
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
}
