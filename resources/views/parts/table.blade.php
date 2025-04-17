<form action="{{ route('parts.index') }}" method="GET" class="mb-3">
    <div class="input-group">
        <input type="text" name="search" class="form-control" placeholder="Buscar por nombre" value="{{ $search }}">
        <div class="input-group-append">
            <button type="submit" class="btn btn-primary">Busqueda</button>
        </div>
    </div>
</form>
<div class="table-responsive">
    <table class="table" id="sales-table">
        <thead>
        <tr>
            <th>Nombre</th>
        <th>Link</th>
        <th>Observaciones</th>
        <th colspan="3">Acciones</th>
        </tr>
        </thead>
        <tbody>
        @foreach($parts as $partss)
            <tr>
                <td>{{ $partss->name }}</td>
            <td><a target="_blank" href="{{ $partss->url }}">https://recambiostablet.com/</a></td>
            <td>{{ $partss->observations }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['parts.destroy', $partss->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('parts.show', [$partss->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('parts.edit', [$partss->id]) }}"
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
</div>
<div class="card-footer product-table d-flex justify-content-between align-items-center">
<div>Mostrando  {{ $parts->firstItem() }} de {{ $parts->lastItem() }} de {{ $parts->total() }} valores</div>
                <div>{{ $parts->appends(['search' => $search])->onEachSide(0)->links() }}</div>
</div>