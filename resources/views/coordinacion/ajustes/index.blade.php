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
    <div class="card m-2 border-dark">
        <div class="card-header lead">Período de clases</div>
        <div class="card-body">
            <label>Agregar un nuevo período de clases</label>
            <form class="form-row" action="{{route('coordinacion.ajustes.agregarPeriodo')}}" method="POST">
                @csrf
                <div class="col-12 col-lg-2">
                    <label class="sr-only" for="nombre">Nombre del período</label>
                    <input type="text" class="form-control mb-2 mr-sm-2" id="nombre" name="nombre"
                        placeholder="Ej: 1902.01" value="{{old('nombre')}}">
                </div>

                <div class="col-12 col-lg-2">
                    <label class="sr-only" for="descripcion">Descripción del período</label>
                    <input type="text" class="form-control mb-2 mr-sm-2" id="descripcion" name="descripcion"
                        placeholder="Ej: Verano 2019 Interno" value="{{old('descripcion')}}">
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
            <form class="form-row" method="POST" action="{{route('coordinacion.ajustes.periodoVigente')}}">
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
    <hr>
    <div class="card m-2 border-dark">
        <div class="card-header lead">Ajustes de observación docente</div>
        <div class="card-body">
            <label>Agregar un nuevo observador</label>
            <form class="form-row" action="{{route('coordinacion.ajustes.agregarObservador')}}" method="POST">
                @csrf
                <div class="col-12 col-lg-5">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Nombre del observador</span>
                        </div>
                        <input type="text" class="form-control" name="nombre_observador" id="nombre_observador" required
                            value="{{old('nombre_observador')}}">
                    </div>
                </div>
                <div class="col-12 col-lg-5">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Username del observador</span>
                        </div>
                        <input type="text" class="form-control" name="username_observador" id="username_observador" required
                            value="{{old('username_observador')}}">
                    </div>
                </div>

                <div class="col-12 col-lg-2">
                    <button type="submit" class="btn btn-primary mb-2 btn-block">Guardar</button>
                </div>
            </form>
            <hr>
            <label>Agregar una nueva categoria de observación de clases</label>
            <form class="form-row" action="{{route('coordinacion.ajustes.agregarCategoriaObservaciones')}}"
                method="POST">
                @csrf
                <div class="col-12 col-lg-10">
                    <label class="sr-only" for="nombre_categoria">Nombre de la categoría</label>
                    <input type="text" class="form-control mb-2 mr-sm-2" id="nombre_categoria" name="nombre_categoria"
                        placeholder="Ej: TEACHING APPROACHES" value="{{old('nombre_categoria')}}">
                </div>
                <div class="col-12 col-lg-2">
                    <button type="submit" class="btn btn-primary mb-2 btn-block">Guardar</button>
                </div>
            </form>
            <hr>
            <label>Agregar un nuevo ítem de observación de clases</label>
            <form class="form-row" action="{{route('coordinacion.ajustes.agregarItemCategoria')}}" method="POST">
                @csrf
                <div class="col-12 col-lg-12">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Texto del ítem</span>
                        </div>
                        <textarea class="form-control" name="texto_item" id="texto_item" rows="2"
                            required>{{old('texto_item')}}</textarea>
                    </div>
                </div>
                <div class="col-12 col-lg-9 py-2">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="categorias_item">Categoría:</label>
                        </div>
                        <select class="form-control" id="id_categorias" name="id_categoria">
                            @foreach ($categorias as $categoria)
                            <option value="{{$categoria->id}}">
                                {{$categoria->nombre_categoria}}
                            </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-12 col-lg-3 py-2">
                    <button type="submit" class="btn btn-primary mb-2 btn-block">Agregar</button>
                </div>
            </form>
            <hr>
        </div>
    </div>
    <hr>
    <div class="card m-2 border-dark">
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

    @endsection