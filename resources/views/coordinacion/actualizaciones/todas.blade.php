@extends('coordinacion.actualizaciones.index')
@section('contenido')

<h2 id="titulo" class="text-center text-uppercase py-1">Todas las actualizaciones</h2>
<div class="container">
    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead>
                <tr class="text-center text-uppercase">
                    <td>Fecha</td>
                    <td>Profesor(a)</td>
                    <td>Título</td>
                    <td>No. horas</td>
                    <td>Estado</td>
                </tr>
            </thead>
            <tbody>
                @foreach($actualizaciones as $key => $actualizacion)
                <tr class="text-center">
                    <td>{{ $actualizacion->created_at->format('Y-m-d') }}</td>
                    <td>{{ $actualizacion->profesor->nombre }}</td>
                    <td class="text-center"><strong>
                    @switch($actualizacion->id_status)
                    @case(1)
                    <u><a class="text-dark" href="{{route('coordinacion.actualizaciones.ver', ['id' => $actualizacion->id])}}">
                            {{ $actualizacion->nombre_curso }}
                    </a></u>
                    @break
                    @case(2)                    
                    <u><a class="text-success" href="{{route('coordinacion.actualizaciones.ver', ['id' => $actualizacion->id])}}">
                            {{ $actualizacion->nombre_curso }}
                    </a></u>
                    @break
                    @case(3)
                    <u><a class="text-danger" href="{{route('coordinacion.actualizaciones.ver', ['id' => $actualizacion->id])}}">
                            {{ $actualizacion->nombre_curso }}
                    </a></u>
                    @break
                    @default

                    @endswitch
                    </strong></td>
                    <td>{{$actualizacion->duracion}}</td>
                    @switch($actualizacion->id_status)
                    @case(1)
                    <td class="bg-warning"><strong>{{ $actualizacion->status->nombre}}</strong></td>
                    @break
                    @case(2)
                    <td class="bg-success"><strong>{{ $actualizacion->status->nombre}}</strong></td>
                    @break
                    @case(3)
                    <td class="text-danger">
                        <strong><u>
                            <a class="text-danger" href="{{route('coordinacion.actualizaciones.ver', ['id' => $actualizacion->id])}}">
                            {{ $actualizacion->status->nombre}}</a>
                        </u></strong>
                    </td>
                    @break
                    @default

                    @endswitch
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection

<script>
    window.onload = function () {
        generarArchivo();
    };
function generarArchivo() {
    var actualizaciones = {!! json_encode($actualizaciones->toArray()) !!};
    console.log(actualizaciones);

}
</script>