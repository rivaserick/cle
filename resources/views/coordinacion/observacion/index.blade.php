@extends('layouts.app')
@section('content')
<link href="https://fonts.googleapis.com/css?family=Playfair+Display:700,900" rel="stylesheet">
<div class="container">
    <!-- will be used to show any messages -->
    @if (Session::has('message'))
    <div class="alert alert-info">{{ Session::get('message') }}</div>
    @endif

</div>
<div class="container">
    @if ($observaciones->isEmpty())
    <h2 class="text-center text-uppercase py-2">No se han registrado observaciones aún.</h2>
    @else
    <h2 class="text-center text-uppercase py-2">Observaciones registradas</h2>
    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead>
                <tr class="text-center text-uppercase lead">
                    <td>Fecha</td>
                    <td>Grupo</td>
                    <td>Docente</td>
                    <td>Observador</td>
                    <td>Acciones</td>
                </tr>
            </thead>
            <tbody>
                @foreach($observaciones as $key => $observacion)
                <tr class="text-center">
                    <td>{{ $observacion->fecha }}</td>
                    <td>{{ $observacion->grupo->grupo }}</td>
                    <td>{{ $observacion->grupo->profesor->nombre }}</td>
                    <td>{{ $observacion->observador->nombre }}</td>
                    <td>
                        <form class="form" action="{{ route('coordinacion.observacion.feedback') }}" method="POST">
                            @csrf
                            @if ($observacion->fecha_feedback)
                            <button type="submit" name="id" value="{{$observacion->id}}"
                                class="btn btn-outline-primary">Feedback: {{$observacion->fecha_feedback}}</button>
                            @else
                            <button type="submit" name="id" value="{{$observacion->id}}"
                                class="btn btn-dark">Sin feedback</button>
                            @endif
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif
</div>
@endsection