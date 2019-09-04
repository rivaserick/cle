@extends('layouts.app')
@section('content')


<div class="container">
    <h1>Nueva actualización</h1>
    @foreach ($errors->all() as $error)
        <div class="alert alert-danger alert-small">{{ $error }}</div>
    @endforeach
    <form enctype="multipart/form-data" method="POST" action="{{ route('docencia.actualizaciones.guardar') }}">
        @csrf
        <div class="row">
            <div class="col-sm-5 mb-3 col-12">
                <label for="nombre_curso">Nombre del curso</label>
                <input type="text" class="form-control" name="nombre_curso" id="nombre_curso" placeholder="Nombre del curso" value="{{old('nombre_curso')}}" required>
            </div>
            <div class="col-sm-5 mb-3 col-6">
                <label for="instruido_por">Impartido por</label>
                <input type="text" class="form-control" name="instruido_por" id="instruido_por" placeholder="Organización" value="{{old('instruido_por')}}" required>
            </div>
            <div class="col-sm-2 mb-3 col-6">
                <label for="duracion">Duración</label>
                <input type="number" class="form-control" name="duracion" id="duracion" placeholder="Horas" value="{{old('duracion')}}" required>
            </div>
            <div class="col-sm-12 col-12">
                <div class="form-group">
                    <label for="descripcion">Descripción (min. 15 caracteres.)</label>
                    <textarea class="form-control" name="descripcion" id="descripcion" rows="2" required>{{old('descripcion')}}</textarea>
                </div>
            </div>
            <div class="col-sm-6 mb-3 col-6">
                <label for="id_linea_capacitacion">Línea de capacitación</label>
                <select class="form-control" name="id_linea_capacitacion" id="id_linea_capacitacion" onchange="mostrarSublineas(this.value)"
                value="{{old('id_linea_capacitacion')}}" required>
                    <option value="0">Seleccione...</option>
                    @foreach ($lineasCapacitacion as $linea)
                        <option value="{{$linea->id}}">{{$linea->nombre}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-sm-6 mb-3 col-6">
                    <label for="id_sublinea_capacitacion">Sublínea de capacitación</label>
                    <select class="form-control" name="id_sublinea_capacitacion" id="id_sublinea_capacitacion" value="{{old('id_sublinea_capacitacion')}}" required>
                        <option value="">Seleccione una línea de capacitación...</option>
                    </select>
                </div>
            <div class="col-sm-3 mb-3 col-6">
                <label for="fecha_inicio">Fecha de inicio</label>
                <input type="date" class="form-control" name="fecha_inicio" id="fecha_inicio" placeholder="Inicio" value="{{old('fecha_inicio')}}" required>
            </div>
            <div class="col-sm-3 mb-3 col-6">
                    <label for="fecha_fin">Fecha de fin</label>
                    <input type="date" class="form-control" name="fecha_fin" id="fecha_fin" placeholder="Fin" value="{{old('fecha_fin')}}" required>
                </div>
            <div class="col-sm-6 mb-3 my-1 col-12">
                <label for="evidencia">Evidencia: archivo PDF (Certificado / Diploma) (NO mayor a 5 MB)</label>
                    <input type="file" class="form-control-file" name="evidencia" id="evidencia" value="{{old('evidencia')}}" accept="application/pdf" required>
            </div>
        </div>
        <div class="text-center form-group">
            <a href="{{ route('docencia.actualizaciones.inicio') }}" class="btn btn-danger">Cancelar</a>
            <button class="btn btn-primary" type="submit">Subir actualización</button>
        </div>
    </form>
</div>
<script src="{{ asset('js/jquery-3.4.1.min.js') }}"></script>
<script>    
    function mostrarSublineas(valor) {
        var sublineasCapacitacion = {!! json_encode($sublineasCapacitacion->toArray()) !!};
        sublineasCapacitacion.push({'id_linea_capacitacion':'0','id':'0','nombre':'Seleccione una línea de capacitación...'});
        $('#id_sublinea_capacitacion').text("");
        sublineasCapacitacion.forEach(element => {
            if (element.id_linea_capacitacion == $('#id_linea_capacitacion').val()) {
                var opcion = '<option value='+element.id+'>'+element.nombre+'</option>';
                $('#id_sublinea_capacitacion').append(opcion);
            }
        });
    }
    $(document).ready(function () {
        mostrarSublineas(0);
        $('#id_linea_capacitacion').val({{old('id_linea_capacitacion')}});
        mostrarSublineas({{old('id_linea_capacitacion')}});
        $('#id_sublinea_capacitacion').val({{old('id_sublinea_capacitacion')}});
    });
</script>

@endsection