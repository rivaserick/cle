@extends('coordinacion.actualizaciones.index')
@section('contenido')

<h2 id="titulo" class="text-center text-uppercase py-2">Actualizaciones pendientes de revisión</h2>
<div id="contenido" class="row">
        @foreach($actualizaciones as $key => $actualizacion)
        @if ($actualizacion->id_status < 2) <div class="col-12 col-lg-12">
            @switch($actualizacion->id_status)
            @case(1)
            <div class="card border-warning my-2">
                <div class="card-header border-warning">
                    @break
                    @case(2)
                    <div class="card border-success my-2">
                        <div class="card-header border-success">
                            @break
                            @case(3)
                            <div class="card border-danger my-2">
                                <div class="card-header border-danger">
                                    @break
                                    @default
                                    @endswitch
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
                                            Inicio:
                                            <strong>{{date('d/m/Y', strtotime($actualizacion->fecha_inicio))}}</strong>
                                        </div>
                                        <div class="col-6 col-lg-3">
                                            Fin:
                                            <strong>{{date('d/m/Y', strtotime($actualizacion->fecha_fin))}}</strong>
                                        </div>
                                        <div class="col-6 col-lg-3">
                                            Duración: <strong>{{$actualizacion->duracion}} hr</strong>
                                        </div>
                                        <div class="col-6 col-lg-3">
                                            Evidencia: <a href="{{Storage::disk('s3')->url()}}" target="_blank"
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
                                @if ($actualizacion->id_status == 1)
                                <div class="card-footer bg-warning">
                                    <div class="row">
                                        <div class="col-6">
                                                <form action="{{route('coordinacion.actualizaciones.guardar', ['id' => $actualizacion->id])}}"
                                                method="post">
                                                @method('post')
                                                @csrf
                                                <button type="submit" name="id_status" value="2"
                                                    class="btn btn-success btn-block">Aprobar</button>
                                            </form>
                                        </div>
                                        <div class="col-6">
                                            <form action="{{route('coordinacion.actualizaciones.ver', ['id' => $actualizacion->id])}}"
                                                method="get">
                                                <button type="submit" class="btn btn-danger btn-block">Rechazar</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                        @endif
                        @endforeach
                    </div>
                </div>
            </div>
    </div>

@endsection
