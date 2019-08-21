@extends('layouts.app')
@section('content')

<div class="container">
    <h1 class="display-4">Ajustes de la plataforma</h1>
    @if (Session::has('message'))
    <div class="alert alert-success">{{ Session::get('message') }}</div>
    @endif
    @foreach ($errors->all() as $error)
    <div class="alert alert-danger alert-small">{{ $error }}</div>
    @endforeach
    <div class="card">
        <div class="card-header lead">Período de clases</div>
        <div class="card-body">
            <label>Agregar un nuevo período de clases</label>
            <form class="form-row" action="{{route('coordinacion.ajustes.agregarPeriodo')}}" method="POST">
                @csrf
                <div class="col-12 col-lg-2">
                    <label class="sr-only" for="nombre">Nombre del período</label>
                    <input type="text" class="form-control mb-2 mr-sm-2" id="nombre"
                        name="nombre" placeholder="Ej: 1903" value="{{old('nombre')}}">
                </div>

                <div class="col-12 col-lg-2">
                    <label class="sr-only" for="descripcion">Descripción del período</label>
                    <input type="text" class="form-control mb-2 mr-sm-2" id="descripcion" name="descripcion"
                        placeholder="Ej: Verano 2019" value="{{old('descripcion')}}">
                </div>

                <div class="col-12 col-lg-3">
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="fecha_de_inicio">Fecha de inicio</span>
                        </div>
                        <input type="date" name="fecha_de_inicio" id="fecha_de_inicio" class="form-control"
                            aria-describedby="fecha_de_inicio" value="{{old('fecha_de_inicio')}}">
                    </div>
                </div>

                <div class="col-12 col-lg-3">
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="fecha_de_fin">Fecha de fin</span>
                        </div>
                        <input type="date" name="fecha_de_fin" id="fecha_de_fin" class="form-control"
                            aria-describedby="fecha_de_fin" value="{{old('fecha_de_fin')}}">
                    </div>
                </div>

                <div class="col-12 col-lg-2">
                    <button type="submit" class="btn btn-primary mb-2 btn-block">Guardar</button>
                </div>
            </form>
            <hr>
            <label>Seleccionar período vigente</label>
            <form class="form-row" method="POST" action="{{route('coordinacion.ajustes.establecerPeriodoVigente')}}">
                @csrf
                <div class="col-12 col-lg-9">
                    <select name="periodo_vigente" id="periodo_vigente" class="form-control mb-2">
                        @foreach ($periodos as $periodo)
                        <option value="{{$periodo->id}}">
                            {{$periodo->nombre}} - {{$periodo->descripcion}}
                            @if ($periodo->vigente)
                                (Vigente)                                
                            @endif
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-12 col-lg-3">
                    <button class="btn btn-primary mb-2 btn-block" type="submit">Establecer como vigente</button>
                </div>
            </form>

        </div>


    </div>
    <div class="card">
        <div class="card-header lead">Importar profesores activos a la base de datos (desde archivo .csv)</div>
        <div class="card-body">
            <form class="form-row" enctype="multipart/form-data" method="POST"
                action="{{route('coordinacion.ajustes.altaDocentesActivos')}}">
                @csrf
                <div class="col-12 col-lg-3">
                    <label for="archivo_docentes">Archivo (formato: .csv):</label>
                </div>
                <div class="col-12 col-lg-7 mb-2">
                    <input type="file" class="form-control-file" name="archivo_docentes" id="archivo_docentes"
                        accept=".csv" required>
                </div>
                <div class="col-12 col-lg-2 mb-2">
                    <button type="submit" class="btn btn-primary btn-block">Importar archivo</button>
                </div>
        </div>


        </form>
    </div>
</div>

@endsection