<!-- Print Method Field -->
<div class="col-sm-12">
    {!! Form::label('print_method', 'Metodo de Impresion:') !!}
    <p>{{ $tickets->print_method }}</p>
</div>

<!-- Autoprint Field -->
<div class="col-sm-12">
    {!! Form::label('autoprint', 'Auto Impresion:') !!}
    <p>{{ $tickets->autoprint }}</p>
</div>

<!-- Head Field -->
<div class="col-sm-12">
    {!! Form::label('head', 'Cabeza:') !!}
    <p>{{ $tickets->head }}</p>
</div>

<!-- Barcode Field -->
<div class="col-sm-12">
    {!! Form::label('barcode', 'Barcode:') !!}
    <p>{{ $tickets->barcode }}</p>
</div>

<!-- Paper Size Field -->
<div class="col-sm-12">
    {!! Form::label('paper_size', 'Tamaño del Papel:') !!}
    <p>{{ $tickets->paper_size }}</p>
</div>

<!-- Margin Top Field -->
<div class="col-sm-12">
    {!! Form::label('margin_top', 'Margen Arriba:') !!}
    <p>{{ $tickets->margin_top }}</p>
</div>

<!-- Margin Right Field -->
<div class="col-sm-12">
    {!! Form::label('margin_right', 'Margen Derecho:') !!}
    <p>{{ $tickets->margin_right }}</p>
</div>

<!-- Margin Bottom Field -->
<div class="col-sm-12">
    {!! Form::label('margin_bottom', 'Margen Abajo:') !!}
    <p>{{ $tickets->margin_bottom }}</p>
</div>

<!-- Margin Left Field -->
<div class="col-sm-12">
    {!! Form::label('margin_left', 'Margen Izquierdo:') !!}
    <p>{{ $tickets->margin_left }}</p>
</div>

<!-- Ticket Edit Field -->
<div class="col-sm-12">
    {!! Form::label('ticket_edit', 'Ticket Editar:') !!}
    <p>{{ $tickets->ticket_edit }}</p>
</div>

<!-- Hide Address Field -->
<div class="col-sm-12">
    {!! Form::label('hide_address', 'Esconder Direccion:') !!}
    <p>{{ $tickets->hide_address }}</p>
</div>

<!-- Hide Nifcif Field -->
<div class="col-sm-12">
    {!! Form::label('hide_nifcif', 'Esconder NIF/CIF:') !!}
    <p>{{ $tickets->hide_nifcif }}</p>
</div>

<!-- Hide Phone Field -->
<div class="col-sm-12">
    {!! Form::label('hide_phone', 'Esconder Telefono:') !!}
    <p>{{ $tickets->hide_phone }}</p>
</div>

<!-- Hide Email Field -->
<div class="col-sm-12">
    {!! Form::label('hide_email', 'Esconder Email:') !!}
    <p>{{ $tickets->hide_email }}</p>
</div>

<!-- Hide Website Field -->
<div class="col-sm-12">
    {!! Form::label('hide_website', 'Esconder Website:') !!}
    <p>{{ $tickets->hide_website }}</p>
</div>

<!-- Hide Barcode Field -->
<div class="col-sm-12">
    {!! Form::label('hide_barcode', 'Esconder Barcode:') !!}
    <p>{{ $tickets->hide_barcode }}</p>
</div>
<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', 'Creado:') !!}
    <p>{{ $tickets->created_at }}</p>
</div>
<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', 'Actualizado:') !!}
    <p>{{ $tickets->updated_at }}</p>
</div>



