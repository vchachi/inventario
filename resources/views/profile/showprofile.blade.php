@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Perfil</h1>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    @include('profile.show_fields')
                </div>
            </div>
        </div>
        <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Cambiar logo</h1>
                </div>
        </div>

        <div class="card mb-2">
        
        {!! Form::model($user2, ['route' => ['profile.ChangeProfile'], 'method' => 'post','files' => true]) !!}

            <div class="card-body">
            <div class="form-group col-sm-6">
                {!! Form::label('logo', 'Logo:') !!}
                {!! Form::file('logo', $attributes = array(),['class' => 'form-control']) !!}
                </div>

            <div class="card-footer">
                {!! Form::submit('Cambiar Imagen', ['class' => 'btn btn-primary']) !!}
             </div>
             </div>
        {!! Form::close() !!}
        </div>

        <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Empresa</h1>
                </div>
        </div>

        <div class="card">
        
        {!! Form::model($user2, ['route' => ['profile.cahngeempresa', $user2->id], 'method' => 'post']) !!}

            <div class="card-body">
            <div class="form-group col-sm-6">
                {!! Form::label('empresa', 'Empresa Actual:') !!}
                {!! Form::select('empresa', $companies, null, ['class' => 'form-control custom-select']) !!}
            </div>
            </div>

            <div class="card-footer">
                {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
             </div>
        {!! Form::close() !!}
        </div>
        

        <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Cambio Clave</h1>
                </div>
        </div>
        <div class="card">
        {!! Form::model($user2, ['route' => ['profile.changepassw', $user2->id], 'method' => 'post']) !!}

<div class="card-body text-center">
<div class="input-group mb-3 col-sm-6">
                    <input type="password"
                           name="password"
                           class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                           placeholder="Password">
                    <div class="input-group-append">
                        <div class="input-group-text"><span class="fas fa-lock"></span></div>
                    </div>
                    @if ($errors->has('password'))
                        <span class="error invalid-feedback">{{ $errors->first('password') }}</span>
                    @endif
                </div>

                <div class="input-group mb-3 col-sm-6">
                    <input type="password"
                           name="password_confirmation"
                           class="form-control"
                           placeholder="Confirm Password">
                    <div class="input-group-append">
                        <div class="input-group-text"><span class="fas fa-lock"></span></div>
                    </div>
                    @if ($errors->has('password_confirmation'))
                        <span class="error invalid-feedback">{{ $errors->first('password_confirmation') }}</span>
                    @endif
                </div>
</div>
<div class="card-footer">
    {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
 </div>
{!! Form::close() !!}
        </div>
    </div>
@endsection
