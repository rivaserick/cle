@extends('layouts.app')
@section('content')
<title>Blog Template for Bootstrap</title>
<!-- Bootstrap core CSS -->
<!-- Custom styles for this template -->
<link href="https://fonts.googleapis.com/css?family=Playfair+Display:700,900" rel="stylesheet">
<div class="container">
    <!-- will be used to show any messages -->
    @if (Session::has('message'))
    <div class="alert alert-info">{{ Session::get('message') }}</div>
    @endif
    <div class="card text-center">
        <div class="card-body">
            <p class="card-text">Ir a la página para subir actualizaciones del período.</p>
            <a href="{{ route('docencia.actualizaciones.registrar') }}" class="btn btn-primary">Subir</a>
        </div>
    </div>
</div>
<div class="container">
    @if ($actualizaciones->isEmpty())
        <h2 class="text-center text-uppercase py-2">No has subido actualizaciones aún.</h2>
    @else
        <h2 class="text-center text-uppercase py-2">Tus actualizaciones</h2>
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr class="text-center text-uppercase lead">
                        <td>Fecha</td>
                        <td>Período</td>
                        <td>Título</td>
                        <td>Estado</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($actualizaciones as $key => $actualizacion)
                    <tr class="text-center">
                        <td>{{ $actualizacion->created_at }}</td>
                        <td>{{ $actualizacion->periodo->descripcion }}</td>
                        <td class="text-left"><u><strong><a class="text-dark" href="{{route('docencia.actualizaciones.ver', ['id' => $actualizacion->id])}}">{{ $actualizacion->nombre_curso }}</a></strong></u></td>
                        @switch($actualizacion->id_status)
                        @case(1)
                        <td class="bg-warning"><strong>{{ $actualizacion->status->nombre}}</strong></td>
                        @break
                        @case(2)
                        <td class="bg-success"><strong>{{ $actualizacion->status->nombre}}</strong></td>
                        @break
                        @case(3)
                        <td class="text-danger">
                            <strong>{{ $actualizacion->status->nombre}}</strong>
                            <u><a class="text-danger" href="{{route('docencia.actualizaciones.ver', ['id' => $actualizacion->id])}}">Ver respuesta</a></u>
                        </td>
                        @break
                        @default

                        @endswitch
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection