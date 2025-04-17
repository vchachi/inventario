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
        if(isset($input['dateTo'])){
            $dateto=$input['dateTo'];
        }
        if(isset($input['dateFrom'])){
            $datefrom=$input['dateFrom'];
        }
        if(isset($input['Fuente'])){
            $select=$input['Fuente'];
        }
        
    ?>
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
            <div class="fullBody">
            <div class="common-body">
                <div class="filter-click">
                    <div class="filter">
                        <h1>Filtros</h1>
                    </div>
                    {!! Form::open(array('route' => 'stat-earnings','method'=>'POST','id' => 'form-id')) !!}
                     
                    <div class="after-click">
                        <div class="clickTable">
                        <ul class="click-ul">
                            <li class="main-li">
                            <ul>
                                <li>
                                    <h3>Fecha desde</h3>
                                    <input type="date" name="dateFrom" value="{{$datefrom}}"  id="dateFrom" class="dateFrom">
                                    </li>
                                    <li>
                                    <h3>Fecha hasta</h3>
                                    <input type="date" name="dateTo" value="{{$dateto}}" id="dateTo" class="dateTo">
                                </li>
                            </ul>
                            </li>
                            <li class="main-li">
                            <ul>
                                <li>
                                    <h3>Fuente:</h3>
                                    <select  name="Fuente" value='{{$select}}' id="Fuente" name="Fuente">
                                    <option {{$select=='0'?'selected':''}} value="0">Todos</option>
                                    <option {{$select=='1'?'selected':''}} value="1">Solo reparaciones</option>
                                    <option {{$select=='2'?'selected':''}} value="2">Solo ventas</option>
                                </select>
                                </li>
                            </ul>
                            </li>
                        </ul>
            
                        
                        </div>
                        <div class="clickBtn">
                        <div class="twoBtn">
                            <button type="button" onclick="reload()">
                                <i class="fa-solid fa-arrow-rotate-left"></i>                              <h4>Reestablecer</h4>
                            </button>
                            <button type="submit">
                                <i class="fa-solid fa-filter"></i>
                                <h4>Filtrar</h4>
                            </button>
                        </div>
                        </div>
                    </div>
            
            {!! Form::close() !!}
            {!! Form::open(array('route' => 'stat-earnings','method'=>'POST','id' => 'form-id2')) !!}
            
             {!! Form::close() !!}
                </div>
            </div>



            <div class="ingresos-full">
                <div class="ingresosHead">
                <h2>Ingresos</h2>
                </div>
                <div class="ingresosBody">
                <div class="ingresosUp">
                    <ul class="ingresosUL">
                    <li class="ingresosLI">
                        <ul>
                        <li><span>Total</span></li>
                        <li><p>{{number_format($ingresos[0]->Total_Vendido, 2, ',', '.') }} €</p></li>
                        </ul>
                    </li>
                    <li class="ingresosLI">
                        <ul>
                        <li><span>Media</span></li>
                        <li><p>{{number_format($ingresos[0]->promedio, 2, ',', '.') }}€</p></li>
                        </ul>
                    </li>
                    </ul>
                </div>
                <div class="ingresosBottom"></div>
                </div>
            </div>
            <div class="ingresos-full">
                <div class="ingresosHead">
                <h2>Actividad</h2>
                </div>
                <div class="ingresosBody">
                <div class="ingresosUp">
                    <ul class="ingresosUL">
                    <li class="ingresosLI">
                        <ul>
                        <li><span>Total</span></li>
                        <li><p>{{$clientecontrdo[0]->ContadoCliente}} clientes</p></li>
                        </ul>
                    </li>
                    <li class="ingresosLI">
                        <ul>
                        <li><span>Media</span></li>
                        <li><p>{{$mediacliente}} clientes</p></li>
                        </ul>
                    </li>
                    </ul>
                </div>
                <div class="ingresosBottom"></div>
                </div>
            </div>


            <div class="calor">
                <div class="heading"><h2>Mapa de calor</h2></div>
                <div class="table">
                    <div class="responsive-table">
                        <div class="days-div">
                            <ul>
                                <li></li>
                                <li><span>Domingo</span></li>
                                <li><span>Lunes</span></li>
                                <li><span>Martes</span></li>
                                <li><span>Miércoles</span></li>
                                <li><span>Jueves</span></li>
                                <li><span>Viernes</span></li>
                                <li><span>Sábado</span></li>
                                <li><span>Total hora</span></li>
                            </ul>
                        </div>
                        <div class="hours-table">
                            <div class="hours-div">
                                <ul>
                                    <li><span>08:00</span></li>
                                    <li><span>09:00</span></li>
                                    <li><span>10:00</span></li>
                                    <li><span>11:00</span></li>
                                    <li><span>12:00</span></li>
                                    <li><span>13:00</span></li>
                                    <li><span>14:00</span></li>
                                    <li><span>15:00</span></li>
                                    <li><span>16:00</span></li>
                                    <li><span>17:00</span></li>
                                    <li><span>18:00</span></li>
                                    <li><span>19:00</span></li>
                                    <li><span>20:00</span></li>
                                    <li><span>21:00</span></li>
                                    <li><span>22:00</span></li>
                                    <li><span>23:00</span></li>
                                    <li><span>Total día</span></li>
                                </ul>
                            </div>
                            <div class="table-main">
                            
        @foreach($arregloDeLavista as $arregloDeLavistas)
        
        <ul>
            @foreach($arregloDeLavistas as $arregloDeLavistass)
            @if ( $arregloDeLavistass['spanColumna'] || $arregloDeLavistass['spanFila'])
            <li><span>{{number_format($arregloDeLavistass['valor'], 2, ',', '.')}}</span></li>
            @else
            <li><div style="border:1px solid;background-color:rgba(54, 153, 255,{{$arregloDeLavistass['porcentaje']/100}});color:black;font-weight:bold;">{{number_format($arregloDeLavistass['valor'], 2, ',', '.')}}</div></li>
            @endif
            @endforeach
            
            </ul>
        @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <!--<div class="ingresos-full">
                <div class="ingresosHead">
                <h2>Ingresos por tiendas</h2>
                </div>
                <div class="ingresosBody">
                <div class="ingresosBodyBottom">
                    <div class="bottomLeft">
                    <span>
                        <i class="fa-solid fa-angles-right"></i>
                    </span>
                    </div>
                    <div class="bottomRight">
                    <h2>Mz. G Lt. 7, Asoc. Viv. Trabaj De Tintaya:</h2>
                    <p>0,00€</p>
                    </div>
                </div>
                <div class="spaceDiv"></div>
                </div>
            </div>-->
            </div>
        </div>
    </div>
    @push('page_scripts')
    <script>
    function reload(){

        document.getElementById("form-id2").submit();
    }
    </script>
        <script src="{{asset('js/estadisticas.js')}}"></script>
    @endpush
@endsection
