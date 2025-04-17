
<form action="{{ route('orders.index') }}" method="GET" class="mb-3">
    <div class="input-group">
        <input type="text" name="search" class="form-control" placeholder="Buscar Numero, Proveedor, Costo de Envio..." value="{{ $search }}">
        <div class="input-group-append">
            <button type="submit" class="btn btn-primary">Busqueda</button>
        </div>
    </div>
</form>
<div class="table-responsive">
    <table class="table" id="orders-table">
        <thead>
        <tr>
            <th>Número</th>
        <th>Fecha</th>
        <th>Estado</th>
        <th>Proveedor</th>
        <th>Almacén</th>
        <th>Coste de envío</th>
        <th>Observaciones</th>
        <th colspan="3">Acciones</th>
        </tr>
        </thead>
        <tbody>
        @foreach($orders as $orders)
            <tr>
                <td>{{ $orders->number }}</td>
            <td>{{ $orders->date }}</td>
            <td>{{ $orders->state==1?'Pendiente':( $orders->state==2?'Pedido Realizado':'Recibido') }}</td>
            <td>{{ $orders->provider }}</td>
            <td>{{ $orders->store }}</td>
            <td>{{ $orders->delivery_costs }}</td>
            <td>{{ $orders->observations }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['orders.destroy', $orders->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('orders.show', [$orders->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('orders.edit', [$orders->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-edit"></i>
                        </a>
                        {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Estas Seguro?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
