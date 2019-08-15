<?php

namespace App\Http\Controllers\coordinacion;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Date;
use App\Actualizacion;
use App\Profesor;
use App\Mensaje;
use Illuminate\Http\Request;

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
        $actualizaciones = Actualizacion::all();

        return \view('coordinacion.actualizaciones.pendientes')
            ->with('actualizaciones', $actualizaciones);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        switch (\request('reporte')) {
            case 'actualizaciones':
                $reporte = "FECHA,PROFESOR(A),NOMBRE DEL CURSO,LINEA CAPACITACION,NO. HORAS,ESTADO";
                $actualizaciones = Actualizacion::all();
        
                foreach ($actualizaciones as $actualizacion) {
                    $entrada_reporte = "";
                    $entrada_reporte .= "\n".$actualizacion->created_at;
                    $entrada_reporte .= ",".$actualizacion->profesor->nombre;
                    $entrada_reporte .= ","."\"".$actualizacion->nombre_curso."\"";
                    $entrada_reporte .= ","."\"".$actualizacion->linea->nombre."\"";
                    $entrada_reporte .= ",".$actualizacion->duracion;
                    $entrada_reporte .= ",".$actualizacion->status->nombre;
                    $reporte .= $entrada_reporte;
                }
        
                $nombre_archivo = "Reporte - Actualizaciones ".Date::now()->format('Y-m-d H:i:s').".csv";
                Storage::put("reportes/reporte_actualizaciones.csv", "\xEF\xBB\xBF".$reporte);
                return Storage::download("reportes/reporte_actualizaciones.csv", $nombre_archivo);
                break;
            
            case 'docentes':
                $reporte = "PROFESOR(A),NO. TOTAL DE HORAS,CALIFICACION SUGERIDA (hr/40)";
                $docentes = Profesor::all();
        
                foreach ($docentes as $docente) {
                    $entrada_reporte = "";
                    $entrada_reporte .= "\n".$docente->nombre;
                    $horas_docente = $docente->actualizaciones->where('id_status', 2)->sum('duracion');
                    $entrada_reporte .= ","."\"".$horas_docente."\"";
                    $entrada_reporte .= ","."\"".($horas_docente*5/40)."\"";
                    $reporte .= $entrada_reporte;
                }
        
                $nombre_archivo = "Reporte - Docentes ".Date::now()->format('Y-m-d H:i:s').".csv";
                Storage::put("reportes/reporte_docentes.csv", "\xEF\xBB\xBF".$reporte);
                return Storage::download("reportes/reporte_docentes.csv", $nombre_archivo);
                break;
            
            default:
                # code...
                break;
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
        if($id == 'todas'){
            $actualizaciones = Actualizacion::all();
            return \view('coordinacion.actualizaciones.todas')
                ->with('actualizaciones', $actualizaciones);
        } else if($id == 'pendientes'){
            $actualizaciones = Actualizacion::where('id_status', 1)->get();
            return \view('coordinacion.actualizaciones.pendientes')
                ->with('actualizaciones', $actualizaciones);
        } else if($id == 'detalles'){
            $actualizaciones = Actualizacion::all();
            return \view('coordinacion.actualizaciones.detalles')
                ->with('actualizaciones', $actualizaciones);
        } 

        $actualizacion = Actualizacion::find($id);
        $mensajes = Mensaje::where('id_actualizacion', $id)->get();
        return \view('coordinacion.show')
            ->with([
            'actualizacion' => $actualizacion,
            'mensaje' => $mensajes[0],
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
        $actualizacion = Actualizacion::find($id);
        $actualizacion->id_status = \request('id_status');

        if(\request('id_status')==3){
            $mensaje = new Mensaje;
            $mensaje->mensaje = \request('mensaje');
            $mensaje->id_actualizacion = $id;
            $mensaje->save();
        }

        $actualizacion->save();
        return CoordinacionController::index();
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
