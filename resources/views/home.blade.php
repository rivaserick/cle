@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Actualizaciones</div>
                <div class="card-body text-center">
                    <a class="btn btn-primary" href="{{route('actualizaciones.index')}}">Actualizaciones</a>
                    <a class="btn btn-primary" href="{{route('observacion.index')}}">Observación</a>
                    <a class="btn btn-primary" href="{{route('coordinacion')}}">Coordinación</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection