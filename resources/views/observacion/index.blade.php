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
            <a href="{{ route('observacion.create') }}" class="btn btn-primary">Subir</a>
        </div>
    </div>
</div>
<div class="container">
    @if ($actualizaciones->isEmpty())
        <h2 class="text-center text-uppercase py-2">No has registrado observaciones aún.</h2>
    @else
        <h2 class="text-center text-uppercase py-2">Observaciones registradas</h2>
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr class="text-center text-uppercase lead">
                        <td>ID</td>
                        <td>Nombre</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($actualizaciones as $key => $actualizacion)
                    <tr class="text-center">
                        <td>{{ $actualizacion->id }}</td>
                        <td>{{ $actualizacion->nombre }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection