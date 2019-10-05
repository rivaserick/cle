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
    <h2 class="text-center text-uppercase py-2">Grupos registradas</h2>
    <div class="table-responsive">
        <table class="table table-striped table-bordered table-sm">
            <thead>
                <tr class="text-center text-uppercase lead">
                    <td>Grupo</td>
                    <td>Docente</td>
                    <td>Fecha</td>
                    <td>Acciones</td>
                </tr>
            </thead>
            <tbody>
                @foreach($grupos as $key => $grupo)
                <tr class="text-center">
                    <td>{{ $grupo->grupo }}</td>
                    <td>{{ $grupo->profesor->nombre }}</td>
                    @if ($grupo->observacion)
                    <td>{{ $grupo->fecha }}</td>
                    <td class="text-center">
                        <form class="form" action="{{ route('observacion.feedback') }}" method="POST"
                            class="text-center">
                            @csrf
                            <button class="btn btn-outline-primary" type="submit" name="id"
                                value="{{$grupo->id}}">
                                Feedback: {{$grupo->fecha_feedback}}
                            </button>
                            @else
                            <button class="btn btn-dark btn-sm" type="submit" name="id" value="{{$observacion->id}}">
                                Sin feedback
                            </button>
                            @endif
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection