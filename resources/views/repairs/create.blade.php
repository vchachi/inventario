@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1>Crear Reparaciones</h1>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">
        
        @include('adminlte-templates::common.errors')
        {!! Form::open(['route' => 'repairs.store']) !!}
            @include('repairs.fields')

            <div style="padding: 30px 0px">
                {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
                <a href="{{ route('repairs.index') }}" class="btn btn-default">Cancelar</a>
            </div>

        {!! Form::close() !!}
    </div>
@endsection

