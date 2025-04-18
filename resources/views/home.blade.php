@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Panel Control</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                        <li class="breadcrumb-item active">Panel Control v1</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{$budgetsTotal}}</h3>

                    <p>Presupuestos </p>
                </div>
                <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                </div>
                <a href="{{ route('budgets.index') }}" class="small-box-footer">Más información <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{$clientsTotal}}</h3>

                    <p>Clientes</p>
                </div>
                <div class="icon">
                    <i class="ion ion-person-add"></i>
                </div>
                <a href="{{ route('clients.index') }}" class="small-box-footer">Más información <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>{{$salesTotal}}</h3>

                    <p>Ordenes</p>
                </div>
                <div class="icon">
                    <i class="ion ion-pie-graph"></i>
                </div>
                <a href="{{ route('sales.index') }}" class="small-box-footer">Más información <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{$repairsTotal}}</h3>

                    <p>Reparaciones</p>
                </div>
                <div class="icon">
                    <i class="ion ion-settings"></i>
                </div>
                <a href="{{ route('repairs.index') }}" class="small-box-footer">Más información <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
    </div>
    <!-- Main row -->
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-12">
                  <!-- Table -->
                  <div class="card">
                    <div class="card-header">
                      <h3 class="card-title">Reparaciones</h3>
                      <div class="card-tools">
                          <button type="button" class="btn btn-tool" data-card-widget="collapse">
                              <i class="fas fa-minus"></i>
                          </button>
                      </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                      <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                          <th class="all">Número serie</th>
                          <th class="all">Cliente</th>
                          <th class="all">Categoria</th>
                          <th class="all">Coste</th>
                          <th class="all">Estado</th>
                        </tr>
                        </thead>
                        <tbody>  
                        @foreach($repairs as $repairs)
                        <tr>
                          <td class="all">{{ $repairs->imei_serie }}</td>
                          <td class="all">{{ $repairs->client_name }}</td>
                          <td class="all">{{ $repairs->category_title }}</td>
                          <td class="all">{{ $repairs->repair_cost }}</td>
                          <td class="all">{{ $repairs->status == '1' ? 'Ingresado' : ($repairs->status == '2' ? 'Taller' : ($repairs->status == '3' ? 'Reparado' : ($repairs->status == '4' ? 'Irreparable' : 'Entregado'))) }}</td>
                        </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                          <th>Número serie</th>
                          <th>Cliente</th>
                          <th>Categoria</th>
                          <th>Coste</th>
                          <th>Estado</th>
                        </tr>
                        </tfoot>
                      </table>
                    </div>
                    <!-- /.card-body -->
                  </div>
                  <!-- /.card -->
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header border-transparent">
                    <h3 class="card-title">Listado Ultimos Presupuestos</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>

                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table m-0">
                            <thead>
                                <tr>      
                                  <th>Numerp</th>
                                  <th>Fecha</th>
                                  <th>Estado</th>
                                  <th>Cliente</th>
                                </tr>
                            </thead>
                            <tbody>
                              @foreach($latestBudget as $latestBudget)
                                <tr>
                                  <td><a href="javascript:void(0)">{{ $latestBudget->number }}</a></td>
                                  <td>{{ $latestBudget->date }}</td>
                                  <td><span class="badge {{ $latestBudget->state == '1' ? 'badge-danger' : ($latestBudget->state == '2' ? 'badge-warning' : ($latestBudget->state == '3' ? 'badge-success' : 'badge-default')) }}">{{ $latestBudget->state == '1' ? 'Pendiente de enviar' : ($latestBudget->state == '2' ? 'Pendiente de aceptar' : ($latestBudget->state == '3' ? 'Aceptado' : 'Rechazado')) }}</span></td>
                                  <td>
                                    <div class="sparkbar" data-color="#00a65a" data-height="20">
                                      {{ $latestBudget->client_name }}
                                    </div>
                                  </td>
                                </tr>
                              @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>

                <div class="card-footer clearfix">
                    <a href="{{ route('budgets.index') }}" class="btn btn-sm btn-info float-right">Ver todos los presupuestos</a>
                </div>

            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Listado Ultimas Ordenes</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
           
                <div class="card-body p-0">
                    <ul class="products-list product-list-in-card pl-2 pr-2">
                    @foreach($latestSales as $latestSales)
                    <li class="item">
                            <div class="product-info">
                                <a href="javascript:void(0)" class="product-title">{{$latestSales->client_name}}
                                    <span class="badge badge-warning float-right">{{$latestSales->total}}€</span></a>
                                <span class="product-description">
                                {{$latestSales->date}}
                                </span>
                            </div>
                        </li>
                              @endforeach

                    </ul>
                </div>

                <div class="card-footer text-center">
                    <a href="{{ route('sales.index') }}" class="uppercase">Ver todas las órdenes</a>
                </div>

            </div>
        </div>
    </div>
    <!-- /.row (main row) -->
</div>
<script>
    document?.addEventListener('DOMContentLoaded', function() {
        var $j = jQuery.noConflict();
        $(function () {
            $('#example1').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "scrollX": true,
            "responsive":true,
            "language": {
            "lengthMenu": "Mostrar _MENU_ registros por página",
            "zeroRecords": "No se encontró nada - lo siento",
            "info": "Mostrando la página _PAGE_ de _PAGES_",
            "infoEmpty": "No hay registros disponibles",
            "search":"Buscar:",
            "paginate": {
        "first":      "Primero",
        "last":       "Ultimo",
        "next":       "Siguiente",
        "previous":   "Anterior"
    },
            "infoFiltered": "(filtrado de _MAX_ registros totales)"
                },
            });
        });
    })
</script>
@endsection