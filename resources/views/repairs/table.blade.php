<form action="{{ route('repairs.index') }}" method="GET" class="mb-3">
    <div class="input-group">
        <input type="text" name="search" class="form-control" placeholder="Buscar Reparacion Numero, Cliente, Categoria..." value="{{ $search }}">
        <div class="input-group-append">
            <button type="submit" class="btn btn-primary">Busqueda</button>
        </div>
    </div>
</form>
<div class="table-responsive">
    <table class="table" id="repairs-table">
        <thead>
        <tr>
            <th>Cliente</th>
        <th>Categoria</th>
        <th>Marca</th>
        <th>Modelo</th>
        <th>Número de serie</th>
        <th>Coste de Reparación</th>
        <th>Concepto</th>
        <th>Estados</th>
        <th>Fecha</th>
            <th colspan="3">Acciones</th>
        </tr>
        </thead>
        <tbody>
        @foreach($repairs as $repairss)
            <tr>
                <td>{{ $repairss->client_name }}</td>
            <td>{{ $repairss->category_title }}</td>
            <td>{{ $repairss->brand }}</td>
            <td>{{ $repairss->model }}</td>
            <td>{{ $repairss->imei_serie }}</td>
            <td>{{ $repairss->repair_cost }}  € </td>
            <td>{{ $repairss->concept }}</td>
            <td>{{ $repairss->status == '1' ? 'Ingresado' : ($repairss->status == '2' ? 'Taller' : ($repairss->status == '3' ? 'Reparado' : ($repairss->status == '4' ? 'Irreparable' : ($repairss->status == '5' ? 'Entregado' : 'Facturado')))) }}</td>
            <td>{{ $repairss->date }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['repairs.destroy', $repairss->id], 'method' => 'delete']) !!}
                    @if ($repairss->status === 6)
                        <a href="{{ route('sales.paidshowRepairs', [$repairss->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i data-toggle="tooltip" data-placement="top" title="show" class="far fa-file-pdf"></i>
                        </a>
                    @else
                    <div class='btn-group'>
                        <a href="{{ route('repairs.show', [$repairss->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i data-toggle="tooltip" data-placement="top" title="Cambiar estado" class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('repairs.edit', [$repairss->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i data-toggle="tooltip" data-placement="top" title="Editar" class="far fa-edit"></i>
                        </a>
                        {!! Form::button('<i data-toggle="tooltip" data-placement="top" title="delete" class="far fa-trash-alt"></i>', ['type' => 'button', 'class' => 'btn btn-danger btn-xs deleteitem']) !!}
                    </div>
                    @endif
                
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
<div>Mostrando {{ $repairs->firstItem() }} de {{ $repairs->lastItem() }} de {{ $repairs->total() }} valores</div>
                <div>{{ $repairs->appends(['search' => $search])->onEachSide(0)->links() }}</div>
</div>
<script>
    document?.addEventListener('DOMContentLoaded', function() {
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        })
        $('#repairs-table .deleteitem').click(function(event){
            var form =  $(this).closest("form");
            var name = $(this).data("name");
            event.preventDefault();
            Swal.fire({
                title: "¿Estás seguro de eliminar este documento?",
                text: "Si lo eliminas será para siempre.",
                icon: "warning",
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si acepto!',
                showCancelButton: true
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        })
    })
</script>