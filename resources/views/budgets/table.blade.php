<!-- Add a search form above the table -->
<form action="{{ route('budgets.index') }}" method="GET" class="mb-3">
    <div class="input-group">
        <input type="text" name="search" class="form-control" placeholder="Buscar Cliente, Numero o Fecha..." value="{{ $search }}">
        <div class="input-group-append">
            <button type="submit" class="btn btn-primary">Busqueda</button>
        </div>
    </div>
</form>
<div class="table-responsive">
    <table class="table" id="budgets-table">
        <thead>
        <tr>
            <th>Número</th>
        <th>Fecha</th>
        <th>Estado</th>
        <th>Cliente</th>
        <th>Observaciones</th>
            <th colspan="3">Acciones</th>
        </tr>
        </thead>
        <tbody>
        @foreach($budgets as $budgets)
            <tr>
                <td>{{ $budgets->number }}</td>
            <td>{{ $budgets->date }}</td>
            <td>{{ $budgets->state == 1 ? "Pendiente de enviar" : ($budgets->state == 2 ? "Pendiente de aceptar" : ($budgets->state == 3 ? "Aceptado" : "Rechazado")) }}</td>
            <td>{{ $budgets->client_name }}</td>
            <td>{{ $budgets->observations }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['budgets.destroy', $budgets->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('budgets.show', [$budgets->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('budgets.edit', [$budgets->id]) }}"
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
