<?php

namespace App\Http\Controllers\Coordinacion;

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
        $this->middleware('coordinacion');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function inicio()
    {
        $observaciones = Observacion::orderBy('created_at')->get();
        return \view('coordinacion.observacion.index')
            ->with('observaciones', $observaciones);
    }

    public function feedback(Request $request){
        $faces = Teacher_selfassessment::all()->sortBy('id');
        $observacion = Observacion::find(\request('id'));
        $categorias = Categoria::all();
        return \view('coordinacion.observacion.show')
            ->with([
                'observacion' => $observacion,
                'categorias' => $categorias,
                'faces' => $faces,
            ]);
    }

}
