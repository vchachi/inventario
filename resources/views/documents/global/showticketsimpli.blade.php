<!DOCTYPE html>
<html>
<head>
  <title>Factura Simplificada</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

  .page_break { page-break-before: always; }
  </style>
</head>
<body>

@foreach ($sales as $ventas)
  <div class="container">
    <div class="row">
      <div class="col-lg-12"style="font-size:10px;margin:3px 0px 0px 0px">
        <div>
          <h3>Factura simplificada</h3>
          <img style="width:50px;height:50px;" src="{{$empresa['image']}}" />
          <p style="font-size:10px;margin:3px 0px 0px 0px">{{$empresa['empresa']}}</p>
          <p style="font-size:10px;margin:3px 0px 0px 0px">NIF: {{$empresa['NIF']}}</p>
          <p style="font-size:10px;margin:3px 0px 0px 0px">Direccion:{{$empresa['direccion']}} </p>
          
          <p style="font-size:10px;margin:3px 0px 0px 0px"><span style="font-weight:900">Nº Factura Simplificada:</span> {{$ventas->salesid}}</p>
          <p style="font-size:10px;margin:3px 0px 0px 0px"><span style="font-weight:900">Fecha:</span> {{$ventas->date}}</p>
        </div>
         <hr style="font-size:10px;margin:3px 0px 0px 0px">
         <div>
         @foreach ($productos as $producto)
         @if($ventas->saleid==$producto->id_sale)
         @if (empty($producto->title))
            <p style="font-size:10px;margin:3px 0px 0px 0px">{{ $producto->concept }} x{{ $producto->amount }} ({{ $producto->price }}EUR)</p>
          @else
            <p style="font-size:10px;margin:3px 0px 0px 0px">{{ $producto->title}} x{{ $producto->amount }} ({{ $producto->price }}EUR)</p>
          @endif  
             @endif
        @endforeach
        </div>
         <hr style="font-size:10px;margin:3px 0px 0px 0px">
         <div>
          <p style="font-size:10px;margin:3px 0px 0px 0px"><span style="font-weight:900">Subtotal:</span> {{$ventas->subtotal}} (EUR)</p>
          <p style="font-size:10px;margin:3px 0px 0px 0px"><span style="font-weight:900">IVA (21%): </span> {{$ventas->iva}} (EUR)</p>
          <p style="font-size:10px;margin:3px 0px 0px 0px"><span style="font-weight:900">Total:</span> {{$ventas->total}} (EUR)</p>
          <p style="font-size:10px;margin:3px 0px 0px 0px"><span style="font-weight:900">Pago:</span> {{$ventas->forma_pago=='1'?'Efectivo': ($ventas->forma_pago=='2'?'Tarjeta':($ventas->forma_pago=='3'?'Bizum':'Transferencia'))}}</p>
        </div>
      </div>
    </div>
  </div>
  
  <div class="page_break"></div>
    @endforeach
</body>
</html>