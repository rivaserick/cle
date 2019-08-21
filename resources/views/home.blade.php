@extends('layouts.app')

@section('content')
<div class="container">
    @if (Session::has('passwordActualizada'))
    <div class="alert alert-info">{{ Session::get('passwordActualizada') }}</div>
    @endif
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">CLE</div>
                <div class="card-body text-center">
                    @switch(Auth::user()->clase())
                        @case(1)
                            <a class="btn btn-primary" href="{{route('actualizaciones.index')}}">Actualizaciones</a>
                            @break
                        @case(3)
                            <a class="btn btn-primary" href="{{route('coordinacion')}}">Coordinación</a>
                            @break
                        @default
                            
                    @endswitch
                </div>
            </div>
        </div>
    </div>
</div>
@endsection