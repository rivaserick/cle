@extends('layouts.app')
@section('content')


<div class="container">
    <h1>Registro de la observación</h1>
    @foreach ($errors->all() as $error)
    <div class="alert alert-danger alert-small">{{ $error }}</div>
    @endforeach
    <form enctype="multipart/form-data" method="POST" action="{{ route('observacion.store') }}">
        @csrf
        <div class="row">
            <div class="col-sm-8 mb-3 col-12">
                <label for="nombre_del_docente">Nombre del docente</label>
                <input type="text" class="form-control" name="nombre_del_docente" id="nombre_del_docente"
                    placeholder="Nombre del docente" value="{{old('nombre_del_docente')}}" list="profesores" required>
                <datalist id="profesores">
                    @foreach ($profesores as $profesor)
                    <option value="{{$profesor->nombre}}">{{$profesor->nombre}}</option>
                    @endforeach
                </datalist>
            </div>
            <div class="col-sm-4 mb-3 col-6">
                <label for="codigo_del_grupo">Código del grupo</label>
                <input type="text" class="form-control" name="codigo_del_grupo" id="codigo_del_grupo"
                    placeholder="Código del grupo" value="{{old('codigo_del_grupo')}}" required>
            </div>
            <div class="col-sm-3 mb-3 col-6">
                <label for="salon">Salón</label>
                <input type="text" class="form-control" name="salon" id="salon" placeholder="Salón"
                    value="{{old('salon')}}" required>
            </div>
            <div class="col-sm-3 mb-3 col-12">
                <label for="fecha_de_observacion">Fecha de observación</label>
                <input type="date" class="form-control" name="fecha_de_observacion" id="fecha_de_observacion"
                    placeholder="Fecha" value="{{old('fecha_de_observacion')}}" required>
            </div>
            <div class="col-sm-3 mb-3 col-6">
                <label for="hora_de_inicio">Hora de inicio</label>
                <input type="time" class="form-control" name="hora_de_inicio" id="hora_de_inicio" placeholder="Inicio"
                    value="{{old('hora_de_inicio')}}" required>
            </div>
            <div class="col-sm-3 mb-3 col-6">
                <label for="hora_de_fin">Hora de fin</label>
                <input type="time" class="form-control" name="hora_de_fin" id="hora_de_fin" placeholder="Fin"
                    value="{{old('hora_de_fin')}}" required>
            </div>
            <div class="col-sm-4 mb-3 col-12">
                    <strong><label for="calificacion">Calificación (/80)</label></strong>
                    <input type="text" class="form-control input-lg" name="calificacion" id="calificacion" placeholder="Calificación"
                        value="{{old('calificacion')}}" required>
                </div>
            <div class="col-sm-8 col-12">
                <div class="form-group">
                    <label for="observaciones">Observaciones (requeridas si la observación es menor a 5
                        min)</label>
                    <textarea class="form-control" name="observaciones" id="observaciones"
                        rows="1">{{old('observaciones')}}</textarea>
                </div>
            </div>
        </div>
        <div class="text-center form-group">
            <a href="{{ route('observacion.index') }}" class="btn btn-danger">Cancelar</a>
            <button class="btn btn-primary" type="submit">Completar registro</button>
        </div>
    </form>
</div>
<script src="{{ asset('js/jquery-3.4.1.min.js') }}"></script>

@endsection