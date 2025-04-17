<div class="table-responsive">
    <table class="table" id="invoiceCustoms-table">
        <thead>
        <tr>
            <th>Texto</th>
            <th colspan="3">Acciones</th>
        </tr>
        </thead>
        <tbody>
        @foreach($invoiceCustoms as $invoiceCustom)
            <tr>
                <td>{{ $invoiceCustom->text }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['invoiceCustoms.destroy', $invoiceCustom->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('invoiceCustoms.show', [$invoiceCustom->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('invoiceCustoms.edit', [$invoiceCustom->id]) }}"
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
