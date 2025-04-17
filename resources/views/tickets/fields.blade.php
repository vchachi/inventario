<!-- Print Method Field -->
<div class="form-group col-sm-6">
    {!! Form::label('print_method', 'Metodo de Impresion:') !!}
    {!! Form::select('print_method', ['1' => ' Navegador', '2' => 'Servidor Local'], null, ['class' => 'form-control custom-select']) !!}
</div>


<!-- Autoprint Field -->
<div class="form-group col-sm-6">
    {!! Form::label('autoprint', 'Impresion Automatica:') !!}
    {!! Form::select('autoprint', ['1' => 'Desabilitada', '2' => 'Habilitada(1 copia)', '3' => 'Habilitada(2 copias)', '4' => 'Habilitada(3 copias)'], null, ['class' => 'form-control custom-select']) !!}
</div>


<!-- Head Field -->
<div class="form-group col-sm-6">
    {!! Form::label('head', 'Cabeza:') !!}
    {!! Form::select('head', ['1' => ' Logo', '2' => ' Titulo'], null, ['class' => 'form-control custom-select']) !!}
</div>


<!-- Barcode Field -->
<div class="form-group col-sm-6">
    {!! Form::label('barcode', 'Barcode:') !!}
    {!! Form::select('barcode', ['1' => 'Code-39(Recomendado)', '2' => 'Code-128(Imagen)'], null, ['class' => 'form-control custom-select']) !!}
</div>


<!-- Paper Size Field -->
<div class="form-group col-sm-6">
    {!! Form::label('paper_size', 'Tipo de Tamaño:') !!}
    {!! Form::select('paper_size', ['1' => '80mm', '2' => '57/58mm'], null, ['class' => 'form-control custom-select']) !!}
</div>


<!-- Margin Top Field -->
<div class="form-group col-sm-6">
    {!! Form::label('margin_top', 'Margen arriba:') !!}
    {!! Form::text('margin_top', null, ['class' => 'form-control']) !!}
</div>

<!-- Margin Right Field -->
<div class="form-group col-sm-6">
    {!! Form::label('margin_right', 'Margen Derecho:') !!}
    {!! Form::text('margin_right', null, ['class' => 'form-control']) !!}
</div>

<!-- Margin Bottom Field -->
<div class="form-group col-sm-6">
    {!! Form::label('margin_bottom', 'Margen Abajo:') !!}
    {!! Form::text('margin_bottom', null, ['class' => 'form-control']) !!}
</div>

<!-- Margin Left Field -->
<div class="form-group col-sm-6">
    {!! Form::label('margin_left', 'Marnge Izquierdo:') !!}
    {!! Form::text('margin_left', null, ['class' => 'form-control']) !!}
</div>

<!-- Ticket Edit Field -->
<div class="form-group col-sm-6">
    {!! Form::label('ticket_edit', 'Ticket Editar:') !!}
    {!! Form::select('ticket_edit', ['1' => 'Generales', '2' => 'Ticket de Info. Reparación', '3' => 'Ticket de Factura S. Reparación', '4' => 'Ticket de Venta'], null, ['class' => 'form-control custom-select']) !!}
</div>


<!-- Hide Address Field -->
<div class="form-group col-sm-6">
    <div class="form-check">
        {!! Form::hidden('hide_address', 0, ['class' => 'form-check-input']) !!}
        {!! Form::checkbox('hide_address', '1', null, ['class' => 'form-check-input']) !!}
        {!! Form::label('hide_address', 'Esconder Direccion', ['class' => 'form-check-label']) !!}
    </div>
</div>


<!-- Hide Nifcif Field -->
<div class="form-group col-sm-6">
    <div class="form-check">
        {!! Form::hidden('hide_nifcif', 0, ['class' => 'form-check-input']) !!}
        {!! Form::checkbox('hide_nifcif', '1', null, ['class' => 'form-check-input']) !!}
        {!! Form::label('hide_nifcif', 'Esconder NIF/CIF', ['class' => 'form-check-label']) !!}
    </div>
</div>


<!-- Hide Phone Field -->
<div class="form-group col-sm-6">
    <div class="form-check">
        {!! Form::hidden('hide_phone', 0, ['class' => 'form-check-input']) !!}
        {!! Form::checkbox('hide_phone', '1', null, ['class' => 'form-check-input']) !!}
        {!! Form::label('hide_phone', 'Esconder Telefono', ['class' => 'form-check-label']) !!}
    </div>
</div>


<!-- Hide Email Field -->
<div class="form-group col-sm-6">
    <div class="form-check">
        {!! Form::hidden('hide_email', 0, ['class' => 'form-check-input']) !!}
        {!! Form::checkbox('hide_email', '1', null, ['class' => 'form-check-input']) !!}
        {!! Form::label('hide_email', 'Esconder Correo', ['class' => 'form-check-label']) !!}
    </div>
</div>


<!-- Hide Website Field -->
<div class="form-group col-sm-6">
    <div class="form-check">
        {!! Form::hidden('hide_website', 0, ['class' => 'form-check-input']) !!}
        {!! Form::checkbox('hide_website', '1', null, ['class' => 'form-check-input']) !!}
        {!! Form::label('hide_website', 'Esconder Website', ['class' => 'form-check-label']) !!}
    </div>
</div>


<!-- Hide Barcode Field -->
<div class="form-group col-sm-6">
    <div class="form-check">
        {!! Form::hidden('hide_barcode', 0, ['class' => 'form-check-input']) !!}
        {!! Form::checkbox('hide_barcode', '1', null, ['class' => 'form-check-input']) !!}
        {!! Form::label('hide_barcode', 'Esconder Barcode', ['class' => 'form-check-label']) !!}
    </div>
</div>
