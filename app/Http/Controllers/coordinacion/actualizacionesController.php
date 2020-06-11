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
        $this->middleware('coordinacion');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function inicio()
    {
        $actualizaciones = Actualizacion::all();

        return \view('coordinacion.actualizaciones.pendientes')
            ->with('actualizaciones', $actualizaciones);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function ver($id)
    {
        if($id == 'todas'){
            $actualizaciones = Actualizacion::all();
            return \view('coordinacion.actualizaciones.todas')
                ->with('actualizaciones', $actualizaciones);
        } else if($id == 'pendientes'){
            $actualizaciones = Actualizacion::where('id_status', 1)->get()->take(10);
            return \view('coordinacion.actualizaciones.pendientes')
                ->with('actualizaciones', $actualizaciones);
        } else if($id == 'detalles'){
            $actualizaciones = Actualizacion::all();
            return \view('coordinacion.actualizaciones.detalles')
                ->with('actualizaciones', $actualizaciones);
        } 

        $actualizacion = Actualizacion::find($id);
        $mensajes = Mensaje::where('id_actualizacion', $id)->get();
        return \view('coordinacion.actualizaciones.show')
            ->with([
            'actualizacion' => $actualizacion,
            'mensajes' => $mensajes,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function guardar(Request $request, $id)
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
        return redirect(\route('coordinacion.actualizaciones.inicio'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function reportes(Request $request)
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

}