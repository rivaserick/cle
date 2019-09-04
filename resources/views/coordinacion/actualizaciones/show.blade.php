@extends('layouts.app')
@section('content')



<div class="container">
    <div class="card my-2">
        <div class="card-header bg-info">
            <div class="row">
                <h4 class="col-6 text-uppercase">
                    <strong>{{$actualizacion->nombre_curso}}</strong>
                </h4>
                <div class="col-6">
                    <h5>
                        <strong>
                            {{$actualizacion->profesor->nombre}}
                        </strong>
                    </h5>
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
        @switch($actualizacion->id_status)
            @case(1)
            <div class="card-footer">
                    <div class="row">
                        <div class="col-6">
                            <form action="{{route('coordinacion.actualizaciones.guardar', ['id' => $actualizacion->id])}}" method="post">
                                @method('PUT')
                                @csrf
                                <button type="submit" name="id_status" value="2"
                                    class="btn btn-success btn-block">Aprobar</button>
                            </form>
                        </div>
                        <div class="col-6">
                            <form action="{{route('coordinacion.actualizaciones.guardar', ['id' => $actualizacion->id])}}" method="post">
                                @method('PUT')
                                @csrf
                                <button type="submit" class="btn btn-danger btn-block" name="id_status" value="3">Rechazar</button>
                                <div class="col-sm-12 col-12">
                                    <div class="form-group text-center">
                                        <label for="descripcion">Mensaje de rechazo</label>
                                        <textarea class="form-control" name="mensaje" id="mensaje" rows="2"
                                            required>{{old('mensaje')}}</textarea>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
                @break
            @case(2)
        </div>
                <div class="alert alert-success text-center">
                    <h4>Esta actualizacion fue <strong>aceptada.</strong></h4>
                </div>
                @break
            @case(3)
        </div>
                <div class="alert alert-danger text-center">
                    <h4 class="alert-heading">Esta actualización fue <strong>rechazada</strong> por el siguiente motivo: </h4>
                    <hr>
                    @foreach ($mensajes as $mensaje)
                    `   <h3>{{$mensaje->mensaje}}</h3>
                    @endforeach
                </div>
                @break
            @default
                
        @endswitch
        <a href="{{route('coordinacion.actualizaciones.inicio')}}" class="btn btn-secondary">Regresar</a> 
</div>
<script src="{{ asset('js/jquery-3.4.1.min.js') }}"></script>

@endsection