@extends('layouts.app')

@section('content')
    @push('page_css')
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="{{asset('css/estadisticas.css')}}"/>
    @endpush
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1>Estadísticas</h1>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">
        <div class="container">
            <div class="stat-cards">
                <div class="stat-card-all">
                
                    <a href="javascript:document.getElementById('form-id').submit();" onclick=""style="width: 100%">
                        <div class="first-card">
                            <span>
                                <i class="fa-solid fa-sack-dollar"></i>
                            </span>
                            <h4>Ingresos</h4>
                        </div>
                    </a>
                    <a href="javascript:document.getElementById('form-id2').submit();" style="width: 100%">
         
                        <div class="second-card">
                            <span>
                                <i class="fa-solid fa-chart-pie"></i>
                            </span>
                            <h4>Rendimiento</h4>
                        </div>
                    </a>
                    <a href="javascript:document.getElementById('form-id3').submit();" style="width: 100%">
         
                        <div class="third-card">
                            <span>
                                <i class="fa-solid fa-box"></i>
                            </span>
                            <h4>Productos</h4>
                        </div>
                    </a>
                    {!! Form::open(array('route' => 'stat-earnings','method'=>'POST','id' => 'form-id')) !!}
            {!! Form::close() !!}
            {!! Form::open(array('route' => 'stat-products','method'=>'POST','id' => 'form-id3')) !!}
            {!! Form::close() !!}
            {!! Form::open(array('route' => 'stat-performance','method'=>'POST','id' => 'form-id2')) !!}
            {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
