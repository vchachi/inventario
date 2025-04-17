<div class="table-responsive">
    <table class="table" id="warranties-table">
        <thead>
        <tr>
            <th>Nombre</th>
        <th>Garantías  Para</th>
        <th>Duracion</th>
        <th>Condiciones</th>
        <th>Url Condiciones</th>
            <th colspan="3">Acciones</th>
        </tr>
        </thead>
        <tbody>
        @foreach($warranties as $warranties)
            <tr>
                <td>{{ $warranties->name }}</td>
            <td>{{ $warranties->warraty_for=='1'?'Todo':($warranties->warraty_for=='2'?'Reparaciones':'Ventas') }}</td>
            <td>{{ $warranties->duration }}</td>
            <td>{{ $warranties->conditions=='1'?'Sitio Web':'Texto' }}</td>
            <td>{{ $warranties->url_conditions }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['warranties.destroy', $warranties->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('warranties.show', [$warranties->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('warranties.edit', [$warranties->id]) }}"
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
