<!-- Add a search form above the table -->
<form action="{{ route('factura.index') }}" method="GET" class="mb-3">
    <div class="input-group">
        <input type="text" name="search" class="form-control" placeholder="Buscar Numero, Cliente, subtotal o total..." value="{{ $search }}">
        <div class="input-group-append">
            <button type="submit" class="btn btn-primary">Busqueda</button>
        </div>
    </div>
</form>
<div class="table-responsive">
    <table class="table" id="sales-table">
        <thead>
        <tr>
            <th>Número Factura</th>
            <th>Nombre Cliente</th>
        <th>Subtotal</th>
        <th>IVA</th>
        <th>Total</th>
        <th>Fecha</th>
            <th colspan="3">Acciones</th>
        </tr>
        </thead>
        <tbody>
        @foreach($sales as $sales)
            <tr>
                <td>{{ $sales->id }}</td>
                <td>{{ $sales->client_name }}</td>
            <td>{{ $sales->subtotal }}</td>
            <td>{{ $sales->iva }}</td>
            <td>{{ $sales->total }}</td>
            <td>{{ $sales->date }}</td>
                <td width="120">
                    @if (!empty($sales->id_repara ))
                    <div class='btn-group'>
                        <a href="{{ route('sales.paidshow', [$sales->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-file"></i>
                        </a>
                       @else
                    <div class='btn-group'>
                        <a href="{{ route('sales.paidshow', [$sales->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-file"></i>
                        </a>
                      @endif
                 
                             </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

<script>

</script>