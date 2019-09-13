@extends('layouts.app')
@section('content')
<script src="{{ asset('js/jquery-3.4.1.min.js') }}"></script>
<link href="https://fonts.googleapis.com/css?family=Playfair+Display:700,900" rel="stylesheet">
<h2 class="lead text-center">Hola, {{auth()->guard('coordinacion')->user()->nombre}}</h2>
<h4 class="text-center">Acciones:</h4>
<div class="container">
    <div class="row justify-content-center py-5">
        <div class="col-md-4 col-12">
            <div class="alert alert-primary text-center" role="alert">
                <h4 class="alert-heading">Capacitación docente</h4>
                <a class="btn btn-lg btn-block btn-primary"
                    href="{{ route('coordinacion.actualizaciones.inicio') }}">Ver módulo</a>
            </div>
        </div>
        <div class="col-md-4 col-12">
            <div class="alert alert-primary text-center" role="alert">
                <h4 class="alert-heading">Observación docente</h4>
                <a class="btn btn-lg btn-block btn-primary" href="{{ route('coordinacion.observacion.inicio') }}">Ver
                    módulo</a>
            </div>
        </div>
        <div class="col-md-4 col-12">
            <div class="alert alert-primary text-center" role="alert">
                <h4 class="alert-heading">Ajustes de la plataforma</h4>
                <a class="btn btn-lg btn-block btn-primary" href="{{ route('coordinacion.ajustes.inicio') }}">Ver
                    módulo</a>
            </div>
        </div>
    </div>
</div>
@endsection