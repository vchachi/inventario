<form action="{{ route('sales.index') }}" method="GET" class="mb-3">
    <div class="input-group">
        <input type="text" name="search" class="form-control" placeholder="Buscar Factura Numero, Cliente, Subtotal..." value="{{ $search }}">
        <div class="input-group-append">
            <button type="submit" class="btn btn-primary">Busqueda</button>
        </div>
    </div>
</form>
<div class="table-responsive">
    <table class="table" id="sales-table">
        <thead>
        <tr>
            <th>Numero Factura</th>
            <th>Nombre Cliente</th>
        <th>Subtotal</th>
        <th>IVA</th>
        <th>Total</th>
        <th>Fecha</th>
            <th colspan="3">Acciones</th>
        </tr>
        </thead>
        <tbody>
        @foreach($sales as $saless)
            <tr>
                <td>{{ $saless->id }}</td>
                <td>{{ $saless->client_name }}</td>
            <td>{{ $saless->subtotal }} € </td>
            <td>{{ $saless->iva }} € </td>
            <td>{{ $saless->total }} € </td>
            <td>{{ $saless->date }}</td>
                    {!! Form::open(['route' => ['sales.destroy', $saless->id], 'method' => 'delete']) !!}
                <td width="120">
                    @if (!empty($saless->id_repara ))
                    <div class='btn-group'>
                        <a href="{{ route('sales.paidshow', [$saless->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-file"></i>
                        </a>
                        <a href="{{ route('repairs.show', [$saless->id_repara]) }}"
                           class='btn btn-default btn-xs'>
                            <i data-toggle="tooltip" data-placement="top" title="show" class="far fa-eye"></i>
                        </a>
                       @else
                    <div class='btn-group'>
                    <a href="{{ route('sales.paidshow', [$saless->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-file"></i>
                        </a>
                        <a href="{{ route('sales.edit', [$saless->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-edit"></i>
                        </a>
                      @endif
                      {!! Form::button('<i data-toggle="tooltip" data-placement="top" title="delete" class="far fa-trash-alt"></i>', ['type' => 'button', 'class' => 'btn btn-danger btn-xs deleteitem']) !!}
                  
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
<div>Mostrando  {{ $sales->firstItem() }} de {{ $sales->lastItem() }} de {{ $sales->total() }} valores</div>
                <div>{{ $sales->appends(['search' => $search])->links() }}</div>
</div>
<script>
    document?.addEventListener('DOMContentLoaded', function() {
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        })
        $('#sales-table .deleteitem').click(function(event){
            var form =  $(this).closest("form");
            var name = $(this).data("name");
            event.preventDefault();
            Swal.fire({
                title: "Estas Segur@ de borrar esta venta?",
                text: "no se podra retornar el borrado.",
                icon: "warning",
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Acepto!',
                cancelButtonText: 'No acepto!',
                showCancelButton: true
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        })
    })
</script>