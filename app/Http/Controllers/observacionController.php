<?php

namespace App\Http\Controllers;

use App\Observador;
use App\Observacion;
use App\Profesor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
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

    public function inicio(){
        return 'inicio';

    }

    public function index()
    {
        /*$observador = new Observador;
        $observador->nombre = "Juan Perez";
        $observador->save();*/

        $obs = Observador::all();
        return \view('observacion.index')
            ->with('actualizaciones', $obs);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $profesores = Profesor::all();
        return \view('observacion.create')
            ->with('profesores', $profesores);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $reglas = array(
            'nombre_del_docente' => [
                'required',
                Rule::in(['Profesor 1', 'Profesor 2']),
                ],
            'codigo_del_grupo' => 'required',
            'salon' => 'required',
            'fecha_de_observacion' => 'required|before_or_equal:today',
            'hora_de_inicio' => 'required|date_format:H:i|before:hora_de_fin',
            'hora_de_fin' => 'required|date_format:H:i|before:now',
            'calificacion' => 'required|integer|min:0|max:80',
        );

        $validator = Validator::make($request->all(), $reglas);

        $validacion = $validator->validate();

        //return $validacion;

        if ($validator->fails()) {

            return route('actualizaciones.create')
                ->withErrors($validacion)
                ->withInput($request->all());

        } else {
            //Guardar datos en una observacion real
            return dd($request->all());
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
