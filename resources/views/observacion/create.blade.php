@extends('layouts.app')
@section('content')


<div class="container">
    <h1>Registro de la observación</h1>
    @foreach ($errors->all() as $error)
    <div class="alert alert-danger alert-small">{{ $error }}</div>
    @endforeach
    <form method="POST" action="{{ route('observacion.guardar') }}">
        @csrf
        <div class="row">
            <div class="col-sm-4 mb-3 col-12">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="codigo_del_grupo">Grupo:</label>
                    </div>
                    <select class="custom-select" id="codigo_del_grupo" name="codigo_del_grupo" style="font-size: 75%"
                        value="{{old('codigo_del_grupo')}}" placeholder="Seleccione..." onchange="mostrarDocente(this);"
                        required>
                        
                        @foreach ($grupos as $grupo)
                        <option value="{{$grupo->grupo}}">{{$grupo->grupo}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-sm-8 mb-3 col-12">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Docente:</span>
                    </div>
                    <input type="text" class="form-control" name="nombre_del_docente" id="nombre_del_docente"
                        value="{{old('nombre_del_docente')}}" disabled>
                </div>
            </div>
        </div>
        <ul class="list-group mb-3">
            @foreach ($categorias as $categoria)
            <li class="list-group-item d-flex justify-content-between align-items-center list-group-item-dark">
                {{$categoria->nombre_categoria}}
            </li>
            @foreach ($categoria->items as $item)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                {{$item->texto_item}}
                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                    <label class="btn btn-danger">
                        <input type="radio" name="{{$item->id}}" value="0"><strong>0</strong>
                    </label>
                    <label class="btn btn-outline-dark">
                        <input type="radio" name="{{$item->id}}" value="1"><strong>1</strong>
                    </label>
                    <label class="btn btn-outline-dark">
                        <input type="radio" name="{{$item->id}}" value="2"><strong>2</strong>
                    </label>
                    <label class="btn btn-outline-dark">
                        <input type="radio" name="{{$item->id}}" value="3"><strong>3</strong>
                    </label>
                    <label class="btn btn-success">
                        <input type="radio" name="{{$item->id}}" value="4"><strong>4</strong>
                    </label>
                </div>
            </li>
            @endforeach
            @endforeach
        </ul>
        <hr>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text">Strengths observed:</span>
            </div>
            <textarea class="form-control" id="strengths_observed" name="strengths_observed"
                aria-label="strengths_observed" required>

            </textarea>
        </div>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text">Suggestions for improvement:</span>
            </div>
            <textarea class="form-control" id="suggestions_improvement" name="suggestions_improvement"
                aria-label="suggestions_improvement" required>

            </textarea>
        </div>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text">General observations:</span>
            </div>
            <textarea class="form-control" id="general_observations" name="general_observations"
                aria-label="general_observations" required>

            </textarea>
        </div>
        <div class="text-center form-group py-3">
            <a href="{{ route('observacion.inicio') }}" class="btn btn-danger">Cancelar</a>
            <button class="btn btn-primary" type="submit">Completar registro de observación</button>
        </div>
    </form>
</div>
<script src="{{ asset('js/jquery-3.4.1.min.js') }}"></script>
<script>
    function mostrarDocente(valor) {
        var grupo_seleccionado = $('#codigo_del_grupo').val();
        var grupos = {!! json_encode($grupos->toArray()) !!};
        var profesores = {!! json_encode($profesores->toArray()) !!};
        var docente_grupo = grupos.find((x => x.grupo == grupo_seleccionado));
        docente = profesores.find((x => x.id == docente_grupo.id_profesor));
        $('#nombre_del_docente').val(docente.nombre);
    }
    $(document).ready(function () {
        mostrarDocente($('#codigo_del_grupo').val());
        $('#codigo_del_grupo').click(mostrarDocente($('#codigo_del_grupo').val));
    });
</script>
@endsection