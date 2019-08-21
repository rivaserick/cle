@extends('layouts.app')
@section('content')
<script src="{{ asset('js/jquery-3.4.1.min.js') }}"></script>
<link href="https://fonts.googleapis.com/css?family=Playfair+Display:700,900" rel="stylesheet">
<div class="container">
    <nav class="nav nav-pills nav-justified py-3">
        <a href="{{route('coordinacion.actualizaciones.show', ['id' => 'pendientes'])}}"
            class="nav-item mx-2 nav-link active bg-warning text-dark">
            Actualizaciones pendientes
        </a>
        <a href="{{route('coordinacion.actualizaciones.show', ['id' => 'todas'])}}"
            class="nav-item mx-2 nav-link active bg-primary text-light">
            Todas las actualizaciones
        </a>
        <a href="{{route('coordinacion.actualizaciones.show', ['id' => 'detalles'])}}"
            class="nav-item mx-2 nav-link active bg-success text-light">
            Vista detallada
        </a>
    </nav>
    <form class="form-group text-center" action="{{route('coordinacion.actualizaciones.store')}}" method="post">
        @csrf
        <button class="btn btn-dark" type="submit" name="reporte" value="actualizaciones">Descargar reporte de
            ACTUALIZACIONES</button>
        <button class="btn btn-dark" type="submit" name="reporte" value="docentes">Descargar reporte de
            DOCENTES</button>
    </form>
     
    @yield('contenido')

</div>
@endsection