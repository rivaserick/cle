@extends('layouts.app')
@section('content')
<script src="{{ asset('js/jquery-3.4.1.min.js') }}"></script>
<link href="https://fonts.googleapis.com/css?family=Playfair+Display:700,900" rel="stylesheet">
<h2 class="lead text-center">Hola, {{ Auth::user()->name}}</h2>
<h4 class="text-center">Acciones:</h4>
<nav class="navbar navbar-expand navbar-light justify-content-end">
        <div class="container"> <button class="navbar-toggler navbar-toggler-right border-0 ml-auto"
                type="button" data-toggle="collapse" data-target="#nav-coordinacion">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse text-center justify-content-center" id="nav-coordinacion">
                <ul class="navbar-nav">
                    <li class="nav-item mx-2">
                        <a class="btn btn-outline-primary btn-lg navbar-btn ml-md-2" href="{{route('coordinacion.actualizaciones.index')}}">
                            Actualizaciones
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
<div class="container">
    @yield('contenido')
</div>

@endsection