@extends('layouts.app')

@section('content')
    @push('page_css')
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="{{asset('css/estadisticas.css')}}"/>
    @endpush
    <?php 
    $dateto='';
    $datefrom='';
    $select='';
    $select2='';
    $select3='';
        if(isset($input['dateTo'])){
            $dateto=$input['dateTo'];
        }
        if(isset($input['dateFrom'])){
            $datefrom=$input['dateFrom'];
        }
        if(isset($input['categoria_id'])){
            $select=$input['categoria_id'];
        }
        if(isset($input['product_order'])){
            $select2=$input['product_order'];
        }
        if(isset($input['productos_id'])){
            $select3=$input['productos_id'];
        }
        
    ?>
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1>Estadísticas de productos</h1>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">
        <div class="container">
            <div class="fullBody">
                <div class="common-body">
                    <div class="filter-click">
                    {!! Form::open(array('route' => 'stat-products','method'=>'POST','id' => 'form-id')) !!}
            
                        <div class="filter box-bg boxPadding">
                        <h1>Filtrar (0 resultados)</h1>
                        </div>
                        <div class="after-click">
                        <div class="clickTable">
                            <ul class="click-ul">
                            <li class="main-li">
                                <ul>
                                    <li>
                                        <h3>Producto</h3>
                                        <div class="select-wrapper" style="width:100%;">
                                <select class="select-arrow js-example-basic-single"style="width:100%;" name="productos_id" id="productos_id">
                                <option value="" selected>Selecciona Producto</option>
        @foreach ($productosOption as $productOptions)
                        <option value="{{ $productOptions->id }}" >{{ $productOptions->title }}  </option>
        @endforeach
                                </select>
                            </div>
                                    </li>
                                    <li>
                                        <h3>Categoría</h3>
                                        <div class="select-wrapper" style="width:100%;">
                                <select class="select-arrow js-example-basic-single"style="width:100%;" name="categoria_id" id="categoria_id">
                                <option value="" selected>Selecciona Categoria</option>
        @foreach ($categoriaOption as $categoriaOptions)
                        <option value="{{ $categoriaOptions->id }}" >{{ $categoriaOptions->title }}  </option>
        @endforeach
                                </select>
                            </div>
                                    </li>
                                    <li>
                                        <h3>Ordenar por</h3>
                                        <select id="product_order"  name="product_order">
                                            <option {{$select2=='1'?'selected':''}} value="1">Unidades vendidas</option>
                                            <option {{$select2=='2'?'selected':''}} value="2">Facturación</option>
                                            <option {{$select2=='3'?'selected':''}} value="3">Alfabéticamente</option>
                                        </select>
                                    </li>
                                </ul>
                            </li>
                            <li class="main-li">
                                <ul>
                                    <li>
                                        <h3>Fecha desde</h3>
                                        <input type="date" name="dateFrom" id="dateFrom" value="{{$datefrom}}" class="dateFrom">
                                    </li>
                                    <li>
                                        <h3>Fecha hasta</h3>
                                        <input type="date" name="dateTo" value="{{$dateto}}"  id="dateTo" class="dateTo">
                                    </li>
                                </ul>
                            </li>
                            </ul>
                        </div>
                        <div class="clickBtn">
                            <div class="leftBtn left-right">
                                <button type="button" onclick="reload()">
                                <i class="fa-solid fa-xmark"></i>
                                <h4>Limpiar</h4>
                                </button>
                            </div>
                            <div class="rightBtn left-right">
                                <button type="submit">
                                <i class="fa-solid fa-filter"></i>
                                <h4>Filtrar</h4>
                                </button>
                            </div>
                        </div>
                        </div>
                        {!! Form::close() !!}
                        {!! Form::open(array('route' => 'stat-products','method'=>'POST','id' => 'form-id2')) !!}
            
            {!! Form::close() !!}
                    </div>
                </div>


                <div class="productsTable">
                <table class="table" id="repairs-table">
        <thead>
        <tr>
            <th>Producto</th>
        <th>Facturación</th>
        <th>Unidades vendidas</th>
        </tr>
        </thead>
        <tbody>
        @foreach($cantidadProductos as $cantidadProductoss)
            <tr>
        
        <td>{{$cantidadProductoss->NombreProducto}}</td>
                        <td>{{number_format($cantidadProductoss->Totalvendido, 2, ',', '.')}} €</td>
                        <td>{{number_format($cantidadProductoss->TotalCantidad, 2, ',', '.')}} </td>
           
                        </tr>
        @endforeach
        </tbody>
    </table>
       
                </div>

                <div class="facturacion">
                    <div class="facturacion-first">
                        <h2>Total de facturación</h2>
                        <h2>Total de unidades vendidas</h2>
                    </div>
                    <div class="facturacion-second">
                        <h2>{{number_format($TotalUnidades[0]->Totalvendido, 2, ',', '.')}} €</h2>
                        <h2>{{number_format($TotalUnidades[0]->TotalCantidad, 2, ',', '.')}} </h2>
                    </div>
                </div>

                <div class="oops-image">
                    <img src="{{asset('images/repairs-images/not_found.svg')}}" alt="">
                </div>
            </div>
        </div>
    </div>
@endsection
@push('page_scripts')
<script>
    function reload(){

        document.getElementById("form-id2").submit();
    }
    </script>
        <script src="{{asset('js/estadisticas.js')}}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
    $('.js-example-basic-single').select2();

  } )
  function changevalue(productoid,categoriid){
    console.log(productoid)
    $('#productos_id').val(productoid)
    $('#productos_id').trigger('change');
    $('#categoria_id').val(categoriid)
    $('#categoria_id').trigger('change');
}
changevalue("{{$select3}}","{{$select}}")
    </script>
@endpush