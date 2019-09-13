@extends('layouts.app')
@section('content')
<script src="{{ asset('js/jquery-3.4.1.min.js') }}"></script>
<link href="https://fonts.googleapis.com/css?family=Playfair+Display:700,900" rel="stylesheet">
<h2 class="lead text-center">Hola, {{auth()->guard('docencia')->user()->nombre}}</h2>
<h4 class="text-center">Acciones:</h4>
<div class="container">
        <div class="row justify-content-center py-5">
            <div class="col-md-4 col-12">
                <div class="alert alert-success text-center" role="alert">
                    <h4 class="alert-heading">Actualizaciones docentes</h4>
                    <a class="btn btn-lg btn-block btn-success"
                        href="{{ route('docencia.actualizaciones.inicio') }}">Ver módulo</a>
                </div>
            </div>
            <div class="col-md-4 col-12">
                <div class="alert alert-success text-center" role="alert">
                    <h4 class="alert-heading">Observación docente</h4>
                    <a class="btn btn-lg btn-block btn-success" href="{{ route('docencia.observacion.inicio') }}">Ver
                        módulo</a>
                </div>
            </div>
        </div>
    </div>
@endsection