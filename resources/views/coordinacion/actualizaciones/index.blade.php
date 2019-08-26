@extends('layouts.app')
@section('content')
<script src="{{ asset('js/jquery-3.4.1.min.js') }}"></script>
<link href="https://fonts.googleapis.com/css?family=Playfair+Display:700,900" rel="stylesheet">
<div class="container">
    <div class="row">
        <div class="col-12 col-md-4 mb-1"><a class="btn btn-warning btn-block" href="">Actualizaciones pendientes</a></div>
        <div class="col-12 col-md-4 mb-1"><a class="btn btn-primary btn-block" href="">Todas las actualizaciones</a></div>
        <div class="col-12 col-md-4 mb-1"><a class="btn btn-success btn-block" href="">Vista detallada</a></div>
    </div>
    <form class="form-group text-center" action="{{route('coordinacion.actualizaciones.store')}}" method="post">
        @csrf
        <button class="btn btn-dark mb-1" type="submit" name="reporte" value="actualizaciones">Descargar reporte de
            ACTUALIZACIONES</button>
        <button class="btn btn-dark mb-1" type="submit" name="reporte" value="docentes">Descargar reporte de
            DOCENTES</button>
    </form>

    @yield('contenido')

</div>
@endsection