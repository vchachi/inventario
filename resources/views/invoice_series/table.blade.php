<div class="table-responsive">
    <table class="table" id="invoiceSeries-table">
        <thead>
        <tr>
            <th>Nombre</th>
        <th>Nombre Corto</th>
        <th>Tipo de Impuesto</th>
        <th>Reparacioens</th>
        <th>Ventas</th>
            <th colspan="3">Acciones</th>
        </tr>
        </thead>
        <tbody>
        @foreach($invoiceSeries as $invoiceSeries)
            <tr>
                <td>{{ $invoiceSeries->nombre }}</td>
            <td>{{ $invoiceSeries->shortname }}</td>
            <td>{{ $invoiceSeries->tax_type }}</td>
            <td>{{ $invoiceSeries->default_repairs }}</td>
            <td>{{ $invoiceSeries->default_sells }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['invoiceSeries.destroy', $invoiceSeries->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('invoiceSeries.show', [$invoiceSeries->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('invoiceSeries.edit', [$invoiceSeries->id]) }}"
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
