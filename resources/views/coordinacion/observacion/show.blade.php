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
    <h2 class="text-center text-uppercase py-2">FEEDBACK</h2>
    <div class="row">
        <div class="col-sm-4 mb-3 col-12">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">Grupo:</span>
                </div>
                <input type="text" class="form-control" value="{{$observacion->grupo->grupo}}" disabled>
            </div>
        </div>
        <div class="col-sm-4 mb-3 col-12">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">Docente:</span>
                </div>
                <input type="text" class="form-control" value="{{$observacion->grupo->profesor->nombre}}" disabled>
            </div>
        </div>
        <div class="col-sm-4 mb-3 col-12">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">Observador:</span>
                </div>
                <input type="text" class="form-control" value="{{$observacion->observador->nombre}}" disabled>
            </div>
        </div>
    </div>
    <div class="table-responsive table-sm">
        <table class="table table-sm">
            <thead>
                <tr class="text-center">
                    <th scope="col">Item</th>
                    <th scope="col">Score</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categorias as $categoria)
                <tr class="table-primary">
                    <th colspan="2" scope="row">{{$categoria->nombre_categoria}}</th>
                </tr>
                @foreach ($observacion->observacion_items as $item)
                @if ($item->item->id_categoria == $categoria->id)
                <tr>
                    <td scope="row" style="font-size: 90%;">{{$item->item->texto_item}}</td>
                    <td>
                        <h3>
                            <span class="badge badge-{{$item->score_item}}">{{$item->score_item}}</span>
                        </h3>
                    </td>
                </tr>
                @endif
                @endforeach
                @endforeach
            </tbody>
        </table>
    </div>
    <h1 class="text-right">SCORE:
        <span class="badge badge-primary">{{$observacion->observacion_items->sum('score_item')}}</span>
        / {{$observacion->observacion_items->count()*4}}</h1>
    <hr>
    <div class="input-group mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text">Strengths observed:</span>
        </div>
        <textarea class="form-control" aria-label="strengths_observed" disabled>
            {{$observacion->strengths_observed_text}}
        </textarea>
    </div>
    <div class="input-group mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text">Suggestions for improvement:</span>
        </div>
        <textarea class="form-control" aria-label="suggestions_improvement" disabled>
            {{$observacion->suggestions_improvement_text}}
        </textarea>
    </div>
    <div class="input-group mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text">General observations:</span>
        </div>
        <textarea class="form-control" aria-label="general_observations" disabled>
            {{$observacion->general_observations_text}}
        </textarea>
    </div>
    <div class="input-group mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text">Observee's comments:</span>
        </div>
        <textarea class="form-control" aria-label="observees_comment" disabled>
                {{$observacion->observees_comment_text}}
            </textarea>
    </div>
    <div class="row" style="background-color: white">
        @foreach ($faces as $face)
        <div class="col-6 col-md-2 text-center">
            <label>
                @if ($observacion->id_teacher_self_assessment == $face->id)
                <input type="radio" name="id_teacher_self_assessment" value="{{$face->id}}" checked disabled>
                @else
                <input type="radio" name="id_teacher_self_assessment" value="{{$face->id}}" disabled>
                @endif
                <img class="img-fluid" src="{{asset($face->ruta_imagen)}}">
            </label>
            {{$face->texto}}
        </div>
        @endforeach
    </div>
    @if ($observacion->fecha_feedback)
    <div class="alert alert-success mb-2" role="alert">
            Feedback de esta observación registrado el: <strong>{{$observacion->fecha_feedback}}</strong>
        </div>
    @else
    <div class="alert alert-warning mb-2" role="alert">
            Feedback para esta observación <strong>aún no registrado.</strong>
        </div>
    @endif
    <div class="text-center mb-3">
        <a href="{{ route('coordinacion.observacion.inicio') }}" class="btn btn-lg btn-dark">Aceptar</a>
    </div>
</div>
@endsection