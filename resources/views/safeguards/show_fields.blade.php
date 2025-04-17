<!-- Title Field -->
<div class="col-sm-12">
    {!! Form::label('title', 'titulo:') !!}
    <p>{{ $safeguards->title }}</p>
</div>

<!-- Text Field -->
<div class="col-sm-12">
    {!! Form::label('text', 'Texto:') !!}
    <p>{{ $safeguards->text }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', 'Creado:') !!}
    <p>{{ $safeguards->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', 'Actualizado:') !!}
    <p>{{ $safeguards->updated_at }}</p>
</div>

