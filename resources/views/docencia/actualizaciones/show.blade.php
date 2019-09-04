@extends('layouts.app')
@section('content')
<div class="container">
    <h1>Detalles de la actualización</h1>
    <div class="card my-2">
        <div class="card-header bg-info">
            <div class="row">
                <h4 class="col-6 text-uppercase">
                    <strong>{{$actualizacion->nombre_curso}}</strong>
                </h4>
                <div class="col-6">
                    lo ha cursado en: <strong>{{$actualizacion->instruido_por}}</strong>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row text-center">
                <div class="col-6 col-lg-3">
                    Inicio: <strong>{{date('d/m/Y', strtotime($actualizacion->fecha_inicio))}}</strong>
                </div>
                <div class="col-6 col-lg-3">
                    Fin: <strong>{{date('d/m/Y', strtotime($actualizacion->fecha_fin))}}</strong>
                </div>
                <div class="col-6 col-lg-3">
                    Duración: <strong>{{$actualizacion->duracion}} hr</strong>
                </div>
                <div class="col-6 col-lg-3">
                    Evidencia: <a href="{{Storage::disk('s3')->url($actualizacion->archivo)}}" target="_blank"
                        class="btn btn-primary btn-sm text-white">Ver PDF</a>
                </div>
                <div class="col-12 text-left my-2">
                    Aplica a:
                    <strong>{{$actualizacion->sublinea->nombre}}</strong>
                    ({{$actualizacion->linea->nombre}})
                </div>
                <div class="col-12 my-1">
                    Descripción:
                    <div class="lead text-left">
                        {{$actualizacion->descripcion}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    @switch($actualizacion->id_status)
        @case(1)
            <div class="alert alert-warning text-center">
                <h4 class="alert-heading">Actualización pendiente</h4>
                <h3>Esta actualizacion no ha sido aceptada o rechazada aún.</h3>
            </div>
            @break
        @case(2)
            <div class="alert alert-success text-center">
                <h4 class="alert-heading">¡Felicitaciones!</h4>
                <h3>Esta actualizacion fue <strong>aceptada.</strong></h3>
            </div>
            @break
        @case(3)
            @foreach ($mensajes as $mensaje)
                <div class="alert alert-danger text-center">
                    <h4 class="alert-heading">Esta actualización fue <strong>rechazada</strong> por el siguiente motivo: </h4>
                    <hr>
                    <h3>{{$mensaje->mensaje}}</h3>
                </div>
            @endforeach
            @break
        @default

    @endswitch
    <a href="{{route('docencia.actualizaciones.inicio')}}" class="btn btn-secondary">Regresar</a>
</div>
<script src="{{ asset('js/jquery-3.4.1.min.js') }}"></script>
@endsection