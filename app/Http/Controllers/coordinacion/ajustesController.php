<?php

namespace App\Http\Controllers\coordinacion;

use App\Http\Controllers\Controller;
use App\Period;
use App\Profesor;
use App\Item;
use App\Categoria;
use App\Grupo;
use App\Observador;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Validator;

class ajustesController extends Controller
{
    public function __construct()
    {
        $this->middleware('coordinacion');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function inicio()
    {
        $categorias = Categoria::orderBy('id')->get();
        $periodos = Period::orderBy('id')->get();
        $profesors = Profesor::orderBy('nombre')->get();
        return \view('coordinacion.ajustes.index')
            ->with([
                'periodos' => $periodos,
                'categorias' => $categorias,
                'profesors' => $profesors,
            ]);
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

    public function agregarObservador(Request $request)
    {
        $reglas = array(
            'nombre_observador' => 'required|unique:observadors,nombre',
            'username_observador' => 'required|unique:observadors,username',
        );

        $validator = Validator::make($request->all(), $reglas);

        $validacion = $validator->validate();

        if ($validator->fails()) {

            return route('coordinacion.ajustes.inicio')
                ->withErrors($validacion)
                ->withInput($request->all());

        } else {
            Observador::create([
                'nombre' => \request('nombre_observador'),
                'username' => \request('username_observador'),
                'password' => bcrypt('observador'),
            ]);

            Session::flash('message', 'Categoría registrada correctamente.');

            return redirect(route('coordinacion.ajustes.inicio'));
        }
    }

    public function agregarCategoriaObservaciones(Request $request)
    {
        $reglas = array(
            'nombre_categoria' => 'required|unique:categorias',
        );

        $validator = Validator::make($request->all(), $reglas);

        $validacion = $validator->validate();

        if ($validator->fails()) {

            return route('coordinacion.ajustes.inicio')
                ->withErrors($validacion)
                ->withInput($request->all());

        } else {
            Categoria::create([
                'nombre_categoria' => \request('nombre_categoria'),
            ]);

            Session::flash('message', 'Categoría registrada correctamente.');

            return redirect()->route('coordinacion.ajustes.inicio');
        }
    }

    public function agregarItemCategoria(Request $request)
    {
        $reglas = array(
            'id_categoria' => 'required|integer',
            'texto_item' => 'required|unique:items',
        );

        $validator = Validator::make($request->all(), $reglas);

        $validacion = $validator->validate();

        if ($validator->fails()) {

            return route('coordinacion.ajustes.inicio')
                ->withErrors($validacion)
                ->withInput($request->all());

        } else {
            Item::create([
                'id_categoria' => \request('id_categoria'),
                'texto_item' => \request('texto_item'),
            ]);

            Session::flash('message', 'Ítem registrado correctamente.');

            return redirect()->route('coordinacion.ajustes.inicio');
        }
    }

    public function altaDocentesActivos(Request $request)
    {
        //$path = $request->file('archivo_docentes')->store('public/archivo_docente/');
        return 'En construccion...';
    }

    public function agregarProfesor(Request $request)
    {
        
        $reglas = array(
            'nombre_profesor' => 'required',
            'username_profesor' => 'required|unique:profesors,username',
        );

        $validator = Validator::make($request->all(), $reglas);

        $validacion = $validator->validate();

        if ($validator->fails()) {

            return route('coordinacion.ajustes.inicio')
                ->withErrors($validacion)
                ->withInput($request->all());

        } else {
            $password = bcrypt('DOCENTE');
            Profesor::create([
                'nombre' => \request('nombre_profesor'),
                'username' => \request('username_profesor'),
                'mcer' => null,
                'password' => $password,
                'original_password' => $password,
            ]);

            Session::flash('message', 'Profesor registrado correctamente.');

            return redirect()->route('coordinacion.ajustes.inicio');
        }
    }

    public function reiniciarPassword(Request $request)
    {        
        $reglas = array(
            'reset_password_profesor_id' => 'required',
        );

        $validator = Validator::make($request->all(), $reglas);

        $validacion = $validator->validate();

        if ($validator->fails()) {

            return route('coordinacion.ajustes.inicio')
                ->withErrors($validacion)
                ->withInput($request->all());

        } else {
            $password = bcrypt('DOCENTE');
            $profesor = Profesor::find(\request('reset_password_profesor_id'));
            $profesor->password = $password;
            $profesor->original_password = $password;

            $profesor->save();

            Session::flash('message', 'Password reiniciada correctamente.');

            return redirect()->route('coordinacion.ajustes.inicio');
        }
    }

    public function agregarGrupo(Request $request)
    {
        
        $reglas = array(
            'clave_grupo' => 'required',
            'periodo_grupo' => 'required',
            'profesor_grupo' => 'required',
        );

        $validator = Validator::make($request->all(), $reglas);

        $validacion = $validator->validate();

        if ($validator->fails()) {

            return route('coordinacion.ajustes.inicio')
                ->withErrors($validacion)
                ->withInput($request->all());

        } else {
            $password = bcrypt('DOCENTE');
            Grupo::create([
                'id' => \request('clave_grupo'),
                'grupo' => \request('clave_grupo'),
                'id_periodo' => \request('periodo_grupo'),
                'id_profesor' => \request('profesor_grupo'),
            ]);

            Session::flash('message', 'Grupo registrado correctamente.');

            return redirect()->route('coordinacion.ajustes.inicio');
        }
    }
}
