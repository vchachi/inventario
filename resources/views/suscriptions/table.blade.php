<div class="table-responsive">
    <table class="table" id="suscriptions-table">
        <thead>
            <tr>
                <th>Titulo</th>
                <th>Frecuencia</th>
                <th>Descripcion</th>
                <th colspan="3">Acciones</th>
            </tr>
        </thead>
        <tbody>
        @foreach($suscriptions as $suscriptions)
            <tr>
                <td>{{ $suscriptions->title }}</td>
            <td>{{ $suscriptions->frequency == 1 ? "Mensual" : ($suscriptions->frequency == 2 ? "Semestral" : "Anual" ) }}</td>
            <td>{{ $suscriptions->description }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['suscriptions.destroy', $suscriptions->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('suscriptions.show', [$suscriptions->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('suscriptions.edit', [$suscriptions->id]) }}"
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
