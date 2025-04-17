<form action="{{ route('clients.index') }}" method="GET" class="mb-3">
    <div class="input-group">
        <input type="text" name="search" class="form-control" placeholder="Buscar Nombre del Cliente, Telefono, NIF..." value="{{ $search }}">
        <div class="input-group-append">
            <button type="submit" class="btn btn-primary">Busqueda</button>
        </div>
    </div>
</form>
<div class="table-responsive">
    <table class="table" id="clients-table">
        <thead>
        <tr>
            <th>Nombre</th>
        <th>Telefono</th>
        <th>NIF</th>
        <th>Email</th>
        <th>Observaciones</th>
            <th colspan="3">Acciones</th>
        </tr>
        </thead>
        <tbody>
        @foreach($clients as $clientss)
            <tr>
                <td>{{ $clientss->fullname }}</td>
            <td>{{ $clientss->phone }}</td>
            <td>{{ $clientss->NIF }}</td>
            <td>{{ $clientss->email }}</td>
            <td>{{ $clientss->observations }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['clients.destroy', $clientss->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('clients.show', [$clientss->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('clients.edit', [$clientss->id]) }}"
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
<style>
                .card-footer.product-table::after {
                    display: none;
                    clear: both;
                    content: "";
                }
                @media screen and (max-width: 768px) {
                    .card-footer.product-table {
                        flex-direction: column;
                    }
                }
                @media screen and ( max-width: 400px ){

li.page-item {

    display: none;
}

.page-item:first-child,
.page-item:nth-child( 2 ),
.page-item:nth-last-child( 2 ),
.page-item:last-child,
.page-item.active,
.page-item.disabled {

    display: block;
}
}
            </style>
<div class="card-footer product-table d-flex justify-content-between align-items-center">
<div>Mostrando {{ $clients->firstItem() }} de {{ $clients->lastItem() }} de {{ $clients->total() }} valores</div>
                <div>{{ $clients->appends(['search' => $search])->onEachSide(0)->links() }}</div>
</div>