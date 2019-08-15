<?php

namespace App\Http\Controllers;

use App\Actualizacion;
use App\Status;
use App\Mensaje;
use App\LineaCapacitacion;
use App\SublineaCapacitacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Validator;

class actualizacionesController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$status = new Status;
        //$status->nombre = 'Rechazada';
        //$status->save();

        $actualizaciones = Actualizacion::where('id_profesor', Auth::id())
            ->with(['periodo', 'status'])
            ->get();

        return \view('actualizaciones.index')
            ->with('actualizaciones', $actualizaciones);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $lineasCapacitacion = LineaCapacitacion::all();
        $sublineasCapacitacion = sublineaCapacitacion::all();

        return \view('actualizaciones.create')
            ->with([
                'lineasCapacitacion' => $lineasCapacitacion,
                'sublineasCapacitacion' => $sublineasCapacitacion,
            ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $id_profesor = Auth::id();

        $actualizacion = new Actualizacion;

        $actualizacion->nombre_curso = \request('nombre_curso');
        $actualizacion->descripcion = \request('descripcion');
        $actualizacion->archivo = \request('archivo');
        $actualizacion->duracion = \request('duracion');
        $actualizacion->instruido_por = \request('instruido_por');
        $actualizacion->fecha_inicio = \request('fecha_inicio');
        $actualizacion->fecha_fin = \request('fecha_fin');
        $actualizacion->id_linea_capacitacion = \request('id_linea_capacitacion');
        $actualizacion->id_sublinea_capacitacion = \request('id_sublinea_capacitacion');

        $reglas = array(
            'nombre_curso' => 'required',
            'descripcion' => 'required|min:15',
            'archivo' => 'required|file|mimes:pdf|max:5120',
            'duracion' => 'required|integer|min:1',
            'instruido_por' => 'required',
            'fecha_inicio' => 'required|before_or_equal:fecha_fin',
            'fecha_fin' => 'required|before_or_equal:today',
            'id_linea_capacitacion' => 'required|integer',
            'id_sublinea_capacitacion' => 'required|integer',
        );

        $validator = Validator::make($request->all(), $reglas);

        $validacion = $validator->validate();

        //return $validacion;

        if ($validator->fails()) {

            return route('actualizaciones.create')
                ->withErrors($validacion)
                ->withInput($request->all());

        } else {

            Session::flash('message', 'Actualización agregada correctamente.');
            $path = $request->file('archivo')->store('public/evidencia/'.$id_profesor);
            $actualizacion->archivo = $path;
            $actualizacion->id_periodo = '1';
            $actualizacion->id_status = '1';
            $actualizacion->id_profesor = $id_profesor;
            $actualizacion->save();

            return ActualizacionesController::index();
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
        $actualizacion = Actualizacion::find($id);
        $mensajes = Mensaje::where('id_actualizacion', $id)->get();
        return \view('actualizaciones.show')
        ->with([
            'actualizacion' => $actualizacion,
            'mensajes' => $mensajes,
        ]);
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
