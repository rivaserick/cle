@extends('layouts.home')

@section('content')
<div class="container">
    <div class="row justify-content-center py-5">
        <div class="col-md-4">
            <div class="alert alert-success text-center" role="alert">
                <h4 class="alert-heading">Docencia</h4>
                <p>En este módulo es posible subir evidencia de capacitación docente, como cursos, diplomados, etc.;
                    Además, también permite dar seguimiento a observaciones de práctica docente.
                </p>
                <a class="btn btn-lg btn-block btn-success" href="{{ route('docencia.login') }}">Entrar como docente</a>
            </div>
        </div>
        <div class="col-md-4">
            <div class="alert alert-dark text-center" role="alert">
                <h4 class="alert-heading">Observación docente</h4>
                <p></p>
                <a class="btn btn-lg btn-block btn-dark" href="{{ route('observacion.login') }}">Entrar como observador</a>
            </div>
        </div>
        <div class="col-md-4">
            <div class="alert alert-primary text-center" role="alert">
                <h4 class="alert-heading">Coordinación</h4>
                <p></p>
                <a class="btn btn-lg btn-block btn-primary" href="{{ route('coordinacion.login') }}">Entrar como coordinador</a>
            </div>
        </div>
    </div>
</div>
@endsection