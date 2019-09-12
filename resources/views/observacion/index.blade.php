@extends('layouts.app')
@section('content')
<link href="https://fonts.googleapis.com/css?family=Playfair+Display:700,900" rel="stylesheet">
<div class="container">
    <!-- will be used to show any messages -->
    @if (Session::has('message'))
    <div class="alert alert-info">{{ Session::get('message') }}</div>
    @endif
    <div class="card text-center">
        <div class="card-body">
            <p class="card-text">Ir a la página para subir observaciones del período.</p>
            <a href="{{ route('observacion.registrar') }}" class="btn btn-primary">Subir</a>
        </div>
    </div>
</div>
<div class="container">
    @if ($observaciones->isEmpty())
        <h2 class="text-center text-uppercase py-2">No has registrado observaciones aún.</h2>
    @else
        <h2 class="text-center text-uppercase py-2">Observaciones registradas</h2>
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr class="text-center text-uppercase lead">
                        <td>Fecha</td>
                        <td>Grupo</td>
                        <td>Docente</td>
                        <td>Acciones</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($observaciones as $key => $observacion)
                    <tr class="text-center">
                        <td>{{ $observacion->fecha }}</td>
                        <td>{{ $observacion->grupo->grupo }}</td>
                        <td>{{ $observacion->grupo->profesor->nombre }}</td>
                        @if ($observacion->fecha_feedback)
                            <td>Retroalimentada</td>
                        @else
                            <td><a href="#">Retro</a></td>                            
                        @endif
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection