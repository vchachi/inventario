<div class="table-responsive">
    <table class="table" id="companies-table">
        <thead>
        <tr>
            <th>Razon Social</th>
        <th>CIF/NIF</th>
        <th>Dirección</th>
        <th>Localidad</th>
        <th>Provincia</th>
        <th>Código postal</th>
        <th>Pais</th>
        <th>Telefono</th>
        <th>Web</th>
        <th>Email</th>
        <th>Logo</th>
            <th colspan="3">Acciones</th>
        </tr>
        </thead>
        <tbody>
        @foreach($companies as $companies)
            <tr>
                <td>{{ $companies->socialname }}</td>
            <td>{{ $companies->CIFNIF }}</td>
            <td>{{ $companies->address }}</td>
            <td>{{ $companies->localidad }}</td>
            <td>{{ $companies->provincia }}</td>
            <td>{{ $companies->postal_code }}</td>
            <td>{{ $companies->country }}</td>
            <td>{{ $companies->phone }}</td>
            <td>{{ $companies->website }}</td>
            <td>{{ $companies->email }}</td>
            <td>{{ $companies->logo }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['companies.destroy', $companies->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('companies.show', [$companies->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('companies.edit', [$companies->id]) }}"
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
