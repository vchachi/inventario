<div class="table-responsive">
    <table class="table" id="safeguards-table">
        <thead>
        <tr>
            <th>Titulo</th>
        <th>Texto</th>
            <th colspan="3">Acciones</th>
        </tr>
        </thead>
        <tbody>
        @foreach($safeguards as $safeguards)
            <tr>
                <td>{{ $safeguards->title }}</td>
            <td>{{ $safeguards->text }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['safeguards.destroy', $safeguards->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('safeguards.show', [$safeguards->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('safeguards.edit', [$safeguards->id]) }}"
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
