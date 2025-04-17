<div class="table-responsive">
    <table class="table" id="tickets-table">
        <thead>
        <tr>
            <th>Metodo de Impresion</th>
        <th>Auto Impresion</th>
        <th>Cabeza</th>
        <th>Barcode</th>
        <th>Tamaño del Papel</th>
        <th>Margen Arriba</th>
        <th>Margen Derecho</th>
        <th>Margen Abajo</th>
        <th>Margen Izquierdo</th>
        <th>Ticket Editar</th>
        <th>Esconder Direccion</th>
        <th>Esconder NIF/CIF</th>
        <th>Esconder Telefono</th>
        <th>Esconder Correo</th>
        <th>Esconder Website</th>
        <th>Esconder Barcode</th>
            <th colspan="3">Acciones</th>
        </tr>
        </thead>
        <tbody>
        @foreach($tickets as $tickets)
            <tr>
                <td>{{ $tickets->print_method=='1'?'Navegador':'Servidor Local' }}</td>
            <td>{{ $tickets->autoprint=='1'?'Desabilitada':($tickets->autoprint=='2'?'Habilitada(1 copia)':($tickets->autoprint=='3'?'Habilitada(2 copias)':'Habilitada(3 copias)'))  }}</td>
            <td>{{ $tickets->head=='1'?'Logo':'Titulo' }}</td>
            <td>{{ $tickets->barcode=='1'?'Code-39(Recomendado)':'Code-128(Imagen)' }}</td>
            <td>{{ $tickets->paper_size=='1'?'80mm':'57/58mm' }}</td>
            <td>{{ $tickets->margin_top }}</td>
            <td>{{ $tickets->margin_right }}</td>
            <td>{{ $tickets->margin_bottom }}</td>
            <td>{{ $tickets->margin_left }}</td>
            <td>{{ $tickets->ticket_edit=='1'?'Generales':($tickets->ticket_edit=='2'?'Ticket de Info. Reparación':($tickets->ticket_edit=='3'?'Ticket de Factura S. Reparación':'Ticket de Venta')) }}</td>
            <td>{{ $tickets->hide_address?'Verdadero':'Falso' }}</td>
            <td>{{ $tickets->hide_nifcif?'Verdadero':'Falso' }}</td>
            <td>{{ $tickets->hide_phone?'Verdadero':'Falso' }}</td>
            <td>{{ $tickets->hide_email?'Verdadero':'Falso'}}</td>
            <td>{{ $tickets->hide_website?'Verdadero':'Falso' }}</td>
            <td>{{ $tickets->hide_barcode?'Verdadero':'Falso' }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['tickets.destroy', $tickets->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('tickets.show', [$tickets->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('tickets.edit', [$tickets->id]) }}"
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
