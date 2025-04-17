<div class="table-responsive">
    <table class="table" id="accessLevels-table">
        <thead>
        <tr>
            <th>Nombre</th>
        <th>Pin</th>
        <th>JSON Permiso</th>
            <th colspan="3">Acciones</th>
        </tr>
        </thead>
        <tbody>
        @foreach($accessLevels as $accessLevels)
            <tr>
                <td>{{ $accessLevels->name }}</td>
            <td>{{ $accessLevels->pin }}</td>
            <td>{{ $accessLevels->permisions_json }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['accessLevels.destroy', $accessLevels->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('accessLevels.show', [$accessLevels->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('accessLevels.edit', [$accessLevels->id]) }}"
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
