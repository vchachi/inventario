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
                    <h1>Rendimiento</h1>
                </div>
            </div>
        </div>
    </section>
    <?php 
    $dateto='';
    $datefrom='';
    $select='';
        if(isset($input['dateTo'])){
            $dateto=$input['dateTo'];
        }
        if(isset($input['dateFrom'])){
            $datefrom=$input['dateFrom'];
        }
        if(isset($input['user_id'])){
            $select=$input['user_id'];
        }
        
    ?>
    <div class="content px-3">
        <div class="container">
            <div class="fullBody">
                <div class="common-body">
                <div class="filter-click">
                {!! Form::open(array('route' => 'stat-performance','method'=>'POST','id' => 'form-id')) !!}
            
                    <div class="filter">
                    <h1>Filtrar</h1>
                    </div>
                    
                    <div class="after-click">
                        
                    <div class="clickTable">
                        <ul class="click-ul">
                        <li class="main-li">
                            <ul>
                                <li>
                                    <h3>Empleado</h3>
                                    <div class="select-wrapper" style="width:100%;">
                                <select class="select-arrow js-example-basic-single"style="width:100%;" name="user_id" id="user_id">
                                <option value="" selected>Selecciona Empleado</option>
        @foreach ($userOption as $userOptions)
                        <option value="{{ $userOptions->id }}" >{{ $userOptions->name }}  </option>
        @endforeach
                                </select>
                            </div>
                                </li>
                            </ul>
                        </li>
                        <li class="main-li">
                            <ul>
                                <li>
                                    <h3>Fecha desde</h3>
                                    <input type="date" name="dateFrom" value="{{$datefrom}}" id="dateFrom" class="dateFrom">
                                </li>
                                <li>
                                    <h3>Fecha hasta</h3>
                                    <input type="date" name="dateTo" value="{{$dateto}}" id="dateTo" class="dateTo">
                                </li>
                            </ul>
                        </li>
                        </ul>
                    </div>
                    <div class="clickBtn">
                        <div class="twoBtn">
                        <button type="button" onclick="reload()">
                            <i class="fa-solid fa-xmark"></i>
                            <h4>Limpiar</h4>
                        </button>
                        <button>
                            <i class="fa-solid fa-filter"></i>
                            <h4>Filtrar</h4>
                        </button>
                        </div>
                    </div>
                    </div>
                    {!! Form::close() !!}
                        {!! Form::open(array('route' => 'stat-performance','method'=>'POST','id' => 'form-id2')) !!}
            
            {!! Form::close() !!}
                </div>
                </div>

            
                <div class="tienda">
                    <ul class="tienda-1st tienda-flex box-bg boxPadding">
                    <li><h3>N° Ventas</h3></li>
                    <li><h3>N° Artículos</h3></li>
                    <li><h3>N° Reparaciones</h3></li>
                    <li><h3>Ventas</h3></li>
                    <li><h3>Reparaciones</h3></li>
                    <li><h3>Total</h3></li>
                    </ul>
                    
                    <ul class="tienda-2nd tienda-flex">
                    <li><h3>{{$totalVentasSinReparaciones[0]->NumeroVentas}}</h3></li>
                    <li><h3>{{number_format($totalVentasSinReparaciones3[0]->TotalCantidad, 2, ',', '.')}}</h3></li>
                    <li><h3>{{$totalVentasRepara[0]->NumeroReparaciones}}</h3></li>
                    <li><h3>{{number_format($totalVentasSinReparaciones2[0]->Totalvendido, 2, ',', '.')}} €</h3></li>
                    <li><h3>{{number_format($totalVentasRepara2[0]->totalrepara, 2, ',', '.')}} €</h3></li>
                    <li><h3>{{number_format($totalVentasSinReparaciones2[0]->Totalvendido + $totalVentasRepara2[0]->totalrepara, 2, ',', '.')}}€</h3></li>
                    </ul>
                </div>

                <div class="depend">
                    <ul class="depend-ul">
                    <li><h3>Dependiente/a</h3></li>
                    <li><h3>N° Ventas</h3></li>
                    <li><h3>N° Artículos</h3></li>
                    <li><h3>N° Reparaciones</h3></li>
                    <li><h3>€ Ventas</h3></li>
                    <li style="margin-right:5px"><h3>€ Reparaciones</h3></li>
                    <li><h3>€ Total</h3></li>
                    </ul>
                    @foreach($Dependientes as $Dependientess)
                    <ul class="depend-ul">
                    <li><h3>{{$Dependientess->name}}</h3></li>
                     <li><h3>{{$Dependientess->NumeroVentas}}</h3></li>
                    <li><h3>{{number_format($Dependientess->CantidadArticulos, 2, ',', '.')}}</h3></li>
                    <li><h3>{{$Dependientess->NumeroRepara}} </h3></li>
                    <li><h3>{{number_format($Dependientess->TotalVenta, 2, ',', '.')}}€ </h3></li>
                    <li style="margin-right:5px"><h3>{{number_format($Dependientess->TotalRepara, 2, ',', '.')}}€</h3></li>
                    <li><h3>{{number_format($Dependientess->TotalRepara+$Dependientess->TotalVenta, 2, ',', '.')}}€</h3></li>

        
                    </ul>        @endforeach
                </div>

                <div class="techno">
                    <ul class="techno-ul">
                    <li><h3>Técnico/a</h3></li>
                    <li><h3>N° Reparaciones</h3></li>
                    <li><h3>€ Reparaciones</h3></li>
                    </ul>
                    
                    <ul class="techno-ul">
                             @foreach($tecnicoRepara as $tecnicoReparas)
        
            <li><h3>{{$tecnicoReparas->nombre}}</h3></li>
                    <li><h3>{{$tecnicoReparas->cuenta}}</h3></li>
                    <li><h3> {{number_format($tecnicoReparas->totalrepara, 2, ',', '.')}}€</h3></li>
        @endforeach
                    </ul>
                    
                </div>
            </div>
        </div>
    </div>
    @push('page_scripts')
    <script type="text/javascript">
        $(document).ready(function() {
    $('.js-example-basic-single').select2();

  } )
  function reload(){

document.getElementById("form-id2").submit();
}
  function changevalue(user_id){
    $('#user_id').val(user_id)
    $('#user_id').trigger('change');
}
changevalue("{{$select}}")
    </script>
        <script src="{{asset('js/estadisticas.js')}}"></script>
    @endpush
@endsection
