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
    @if ($grupos->isEmpty())
    <h2 class="text-center text-uppercase py-2">No han registrado observaciones para tus grupos aún.</h2>
    @else
    <h2 class="text-center text-uppercase py-2">Observaciones de tus grupos</h2>
    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead>
                <tr class="text-center text-uppercase lead">
                    <td>Fecha</td>
                    <td>Grupo</td>
                    <td>Score</td>
                    <td>Acciones</td>
                </tr>
            </thead>
            <tbody>
                @foreach($grupos as $key => $grupo)
                @foreach ($grupo->observaciones as $observacion)
                <tr class="text-center">
                    <td>{{ $observacion->fecha }}</td>
                    <td>{{ $grupo->grupo }}</td>
                    <td>
                        <span class="badge badge-primary">{{$observacion->observacion_items->sum('score_item')}}</span>
                        / {{$observacion->observacion_items->count()*4}}
                    </td>
                    <td class="text-center">
                        <form class="form" action="{{ route('docencia.observacion.feedback') }}" method="POST"
                            class="text-center">
                            @csrf
                            @if ($observacion->fecha_feedback)
                            <button class="btn btn-outline-primary" type="submit" name="id" value="{{$observacion->id}}">
                                Ver feedback
                            </button>
                            @else
                            <button class="btn btn-dark" type="submit" name="id" value="{{$observacion->id}}">
                                Registrar feedback
                            </button>
                            @endif
                        </form>
                    </td>
                </tr>
                @endforeach
                @endforeach
            </tbody>
        </table>
    </div>
    @endif
</div>
@endsection